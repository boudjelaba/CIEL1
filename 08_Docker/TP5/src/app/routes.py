import logging

from flask import Blueprint, jsonify, request

from .models import Student, db

student_bp = Blueprint("student_bp", __name__, url_prefix="/students")


@student_bp.route("", methods=["GET"])
@student_bp.route("/", methods=["GET"])
def list_students():
    students = Student.query.order_by(Student.id).all()
    result = [
        {"id": student.id, "name": student.name, "email": student.email}
        for student in students
    ]
    logging.info("Liste des étudiants consultée")
    return jsonify(result)


@student_bp.route("", methods=["POST"])
@student_bp.route("/", methods=["POST"])
def add_student():
    data = request.get_json()

    if not data or not data.get("name") or not data.get("email"):
        return jsonify({"error": "Invalid data"}), 400

    student = Student(name=data["name"], email=data["email"])
    db.session.add(student)
    db.session.commit()
    logging.info("Étudiant ajouté")

    return jsonify({"message": "Student added"}), 201
