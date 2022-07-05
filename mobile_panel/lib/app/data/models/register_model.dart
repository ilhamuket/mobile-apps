// To parse this JSON data, do
//
//     final registerModel = registerModelFromJson(jsonString);

import 'dart:convert';

RegisterModel registerModelFromJson(String str) =>
    RegisterModel.fromJson(json.decode(str));

String registerModelToJson(RegisterModel data) => json.encode(data.toJson());

class RegisterModel {
  RegisterModel({
    this.firstName,
    this.lastName,
    required this.email,
    this.homeAddres,
    required this.password,
  });

  String? firstName;
  String? lastName;
  String email;
  String? homeAddres;
  String password;

  factory RegisterModel.fromJson(Map<String, dynamic> json) => RegisterModel(
        firstName: json["firstName"],
        lastName: json["lastName"],
        email: json["email"],
        homeAddres: json["homeAddres"],
        password: json["password"],
      );

  Map<String, dynamic> toJson() => {
        "firstName": firstName,
        "lastName": lastName,
        "email": email,
        "homeAddres": homeAddres,
        "password": password,
      };
}
