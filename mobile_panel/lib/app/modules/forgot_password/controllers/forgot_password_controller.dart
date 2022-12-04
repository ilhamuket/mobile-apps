import 'dart:convert';

import 'package:ensiklotari/app/data/Service/network_handler.dart';
import 'package:ensiklotari/app/data/models/forgot_model.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';

class ForgotPasswordController extends GetxController {
  TextEditingController emailController = TextEditingController();

  void forgotPassword() async {
    ForgotModel forgotModel = ForgotModel(email: emailController.text);
    var response = await NetworkHandler.post(
        forgotModelToJson(forgotModel), "password/forgot");

    var data = json.decode(response);
    print(data);
    // await NetworkHandler.storeToken(data["data"]);
    // Get.offAll(Routes.LOGIN);
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
