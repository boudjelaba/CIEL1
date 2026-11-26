from datetime import datetime
import logging
import os

from flask import Flask, jsonify, render_template

os.makedirs("logs", exist_ok=True)
logging.basicConfig(
    filename="logs/log.txt",
    level=logging.INFO,
    format="%(asctime)s - %(message)s"
)

app = Flask(__name__)

@app.route("/")
def home():
    logging.info("Page d'accueil consultée")
    return render_template("index.html")

@app.route("/api/status")
def status():
    logging.info("Route API status consultée")
    return jsonify({
        "status": "OK",
        "timestamp": datetime.now().isoformat()
    })

@app.route("/api/user/<name>")
def user(name):
    logging.info("Route API user consultée")
    return jsonify({
        "name": name,
        "role": "student"
    })

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
