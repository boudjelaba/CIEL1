# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>


---

```bash
#!/bin/bash
# Script d'installation automatique du Hotspot Wi-Fi + NAT
# Auteur : [Nom du binôme]
# Date : [Date]
# Usage : ./install_hotspot.sh [--debug]

# --- Configuration ---
SSID="ProjetRPi"
PASSPHRASE="VotreMotDePasseWPA2"
INTERFACE_WIFI="wlan0"
INTERFACE_ETH="eth0"
IP_RANGE="192.168.4.0/24"
DHCP_START="192.168.4.2"
DHCP_END="192.168.4.20"

# --- Fonctions utiles ---
function log() {
    echo "[$(date +'%Y-%m-%d %H:%M:%S')] $1"
}

function error_exit() {
    log "ERREUR: $1" >&2
    exit 1
}

function check_root() {
    if [ "$(id -u)" -ne 0 ]; then
        error_exit "Ce script doit être exécuté en root (sudo)."
    fi
}

function install_packages() {
    log "Installation des paquets nécessaires..."
    apt-get update || error_exit "Échec de la mise à jour des paquets."
    apt-get install -y hostapd dnsmasq iptables netfilter-persistent || error_exit "Échec de l'installation des paquets."
}

function configure_hostapd() {
    log "Configuration de hostapd..."
    cat > /etc/hostapd/hostapd.conf <<EOF
interface=$INTERFACE_WIFI
driver=nl80211
ssid=$SSID
hw_mode=g
channel=6
wmm_enabled=0
macaddr_acl=0
auth_algs=1
ignore_broadcast_ssid=0
wpa=2
wpa_passphrase=$PASSPHRASE
wpa_key_mgmt=WPA-PSK
wpa_pairwise=TKIP
rsn_pairwise=CCMP
EOF
    sed -i "s/#DAEMON_CONF=\"\"/DAEMON_CONF=\"\/etc\/hostapd\/hostapd.conf\"/" /etc/default/hostapd
}

function configure_dnsmasq() {
    log "Configuration de dnsmasq..."
    mv /etc/dnsmasq.conf /etc/dnsmasq.conf.bak
    cat > /etc/dnsmasq.conf <<EOF
interface=$INTERFACE_WIFI
dhcp-range=$DHCP_START,$DHCP_END,$IP_RANGE,24h
dhcp-option=3,$IP_RANGE
server=8.8.8.8
EOF
}

function configure_nat() {
    log "Configuration du NAT..."
    echo 1 > /proc/sys/net/ipv4/ip_forward
    iptables -t nat -A POSTROUTING -o $INTERFACE_ETH -j MASQUERADE
    iptables -A FORWARD -i $INTERFACE_WIFI -o $INTERFACE_ETH -j ACCEPT
    iptables -A FORWARD -i $INTERFACE_ETH -o $INTERFACE_WIFI -m state --state RELATED,ESTABLISHED -j ACCEPT
    netfilter-persistent save
}

function enable_services() {
    log "Activation des services..."
    systemctl unmask hostapd
    systemctl enable hostapd dnsmasq
    systemctl restart hostapd dnsmasq
}

function test_connection() {
    log "Test de la connexion Wi-Fi..."
    sleep 5
    if iwconfig $INTERFACE_WIFI | grep -q "$SSID"; then
        log "Hotspot '$SSID' est actif."
    else
        error_exit "Le hotspot n'est pas actif. Vérifiez les logs avec 'journalctl -u hostapd'."
    fi
}

# --- Exécution ---
check_root
if [ "$1" = "--debug" ]; then
    set -x
fi

install_packages
configure_hostapd
configure_dnsmasq
configure_nat
enable_services
test_connection

log "Installation terminée avec succès !"
log "Connectez-vous au Wi-Fi '$SSID' avec le mot de passe '$PASSPHRASE'."
```
