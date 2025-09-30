# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>


---

```bash
#!/bin/bash
# Script d'installation et configuration Samba NAS
# Usage : sudo ./install_samba.sh

set -e

echo "=== Mise à jour du système ==="
apt update && apt upgrade -y

echo "=== Installation de Samba ==="
apt install -y samba

echo "=== Sauvegarde de la configuration Samba existante ==="
if [ -f /etc/samba/smb.conf ]; then
    cp /etc/samba/smb.conf /etc/samba/smb.conf.bak.$(date +%F-%T)
fi

echo "=== Création des dossiers partagés ==="
mkdir -p /srv/nas/public
mkdir -p /srv/nas/prive

echo "=== Attribution des permissions ==="
chmod 0777 /srv/nas/public
chmod 0700 /srv/nas/prive

echo "=== Configuration Samba ==="
cat <<EOF > /etc/samba/smb.conf
[global]
   workgroup = WORKGROUP
   server string = Raspberry Pi NAS
   map to guest = Bad User
   dns proxy = no

[public]
   path = /srv/nas/public
   browseable = yes
   writable = yes
   guest ok = yes
   force user = nobody

[prive]
   path = /srv/nas/prive
   browseable = no
   writable = yes
   valid users = @smbusers
   create mask = 0700
   directory mask = 0700
EOF

echo "=== Création du groupe smbusers ==="
groupadd -f smbusers

echo "=== Ajout des utilisateurs Samba ==="
# Exemple pour deux étudiants, adapter les noms et mots de passe
for user in etudiant1 etudiant2; do
    if ! id "$user" &>/dev/null; then
        useradd -M -s /sbin/nologin "$user"
    fi
    smbpasswd -a "$user" -n || true
    smbpasswd -e "$user"
    usermod -aG smbusers "$user"
done

echo "=== Modification permissions du dossier privé pour groupe smbusers ==="
chown -R root:smbusers /srv/nas/prive
chmod 0770 /srv/nas/prive

echo "=== Redémarrage du service Samba ==="
systemctl restart smbd

echo "=== Samba NAS configuré avec succès ==="
echo "Partage public : //$(hostname -I | awk '{print $1}')/public (guest accessible)"
echo "Partage privé : //$(hostname -I | awk '{print $1}')/prive (accès restreint aux utilisateurs Samba)"
```
