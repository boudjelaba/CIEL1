import logging
import os
from pathlib import Path

from flask import Flask, jsonify, render_template
from sqlalchemy import text
from sqlalchemy.exc import SQLAlchemyError

from .models import Student, db
from .routes import student_bp


def create_app():
    os.makedirs("logs", exist_ok=True)
    logging.basicConfig(
        filename="logs/log.txt",
        level=logging.INFO,
        format="%(asctime)s - %(message)s"
    )

    app = Flask(__name__)

    app.config["SQLALCHEMY_DATABASE_URI"] = (
        f"postgresql://{os.getenv('POSTGRES_USER')}:{os.getenv('POSTGRES_PASSWORD')}"
        f"@postgres_db:5432/{os.getenv('POSTGRES_DB')}"
    )
    app.config["SQLALCHEMY_TRACK_MODIFICATIONS"] = False

    db.init_app(app)
    app.register_blueprint(student_bp)

    @app.route("/")
    def home():
        database_status = "Connecté"
        try:
            db.session.execute(text("SELECT 1"))
            students = Student.query.order_by(Student.id).all()
        except SQLAlchemyError:
            database_status = "Indisponible"
            students = []
            db.session.rollback()

        logging.info("Tableau de bord consulté")
        log_path = Path("logs/log.txt")
        log_lines = log_path.read_text(encoding="utf-8").splitlines() if log_path.exists() else []

        return render_template(
            "index.html",
            service_status="Application Flask en ligne",
            database_status=database_status,
            students=students,
            log_lines=log_lines[-10:]
        )

    @app.route("/api/status")
    def status():
        return jsonify({"status": "OK"})

    @app.route("/api/student-status")
    def student_status():
        return jsonify({"status": "ok", "message": "API Student Running"})

    @app.route("/api/user/<name>")
    def user(name):
        return jsonify({"name": name, "role": "student"})

    with app.app_context():
        db.create_all()

    return app
