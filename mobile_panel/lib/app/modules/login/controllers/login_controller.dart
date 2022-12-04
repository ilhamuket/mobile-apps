import 'dart:convert';

import 'package:ensiklotari/app/data/Service/network_handler.dart';
import 'package:ensiklotari/app/data/models/login_model.dart';
import 'package:ensiklotari/app/routes/app_pages.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';

class LoginController extends GetxController {
  TextEditingController emailEditingController = TextEditingController();
  TextEditingController passwordEditingController = TextEditingController();

  void loginModel() async {
    LoginModel loginModel = LoginModel(
        email: emailEditingController.text,
        password: passwordEditingController.text);
    var response =
        await NetworkHandler.post(loginModelToJson(loginModel), "/api/login");
    var data = json.decode(response)["meta"];
    var dataisi = json.decode(response)["data"];
    var token = dataisi["token"];
    print(token);
    print(data);
    await NetworkHandler.storeToken(token);

    if (data["code"] == 200) {
      Get.toNamed(Routes.HOME);
    } else {}
  }

  Widget makeInput({controller, iconPref, hintText, obsureText = false}) {
    return TextField(
      cursorColor: Colors.black,
      obscureText: obsureText,
      controller: controller,
      decoration: InputDecoration(
        prefixIconColor: Colors.black,
        contentPadding: EdgeInsets.symmetric(vertical: 15),
        prefixIcon: Padding(
          padding: const EdgeInsets.only(right: 5),
          child: iconPref,
        ),
        hintText: hintText,
        hintStyle: GoogleFonts.spartan(
          textStyle: TextStyle(fontSize: 12, fontWeight: FontWeight.w300),
        ),
        enabledBorder: UnderlineInputBorder(
          borderSide: BorderSide(color: Colors.black.withOpacity(0.5)),
        ),
        focusedBorder: UnderlineInputBorder(
          borderSide: BorderSide(color: Colors.black),
        ),
      ),
    );
  }
}
