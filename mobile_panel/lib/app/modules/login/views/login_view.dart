import 'package:ensiklotari/app/data/ikon_ensiklotari_icons.dart';

import 'package:ensiklotari/app/routes/app_pages.dart';
import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';

import '../controllers/login_controller.dart';

// ignore: must_be_immutable
class LoginView extends GetView<LoginController> {
  var loginController = Get.put(LoginController());
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Color(0xFF84383A),
      body: SafeArea(
        child: Center(
          child: Padding(
            padding: const EdgeInsets.all(15),
            child: Column(
              children: [
                SizedBox(
                  height: 50,
                ),
                Container(
                  child: Image(
                    image: AssetImage("assets/images/ensiklotari.png"),
                  ),
                ),
                SizedBox(
                  height: 50,
                ),
                Container(
                  padding: EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(5),
                  ),
                  // height: MediaQuery.of(context).size.height,
                  width: double.infinity,
                  child: Column(
                    children: [
                      Padding(
                        padding: EdgeInsets.symmetric(horizontal: 15),
                        child: Column(
                          children: [
                            controller.makeInput(
                                controller:
                                    loginController.emailEditingController,
                                iconPref: Icon(IkonEnsiklotari.email),
                                hintText: "Email"),
                            controller.makeInput(
                                controller:
                                    loginController.passwordEditingController,
                                iconPref: Icon(IkonEnsiklotari.password),
                                hintText: "Password"),
                          ],
                        ),
                      ),
                      SizedBox(
                        height: 20,
                      ),
                      Padding(
                        padding: const EdgeInsets.symmetric(horizontal: 15),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            Text(
                              "Doesn't have an account? ",
                              style: GoogleFonts.spartan(
                                textStyle: TextStyle(
                                    fontSize: 10, fontWeight: FontWeight.w500),
                              ),
                            ),
                            GestureDetector(
                              onTap: () => Get.toNamed(Routes.REGISTER),
                              child: Text(
                                "Sign Up",
                                style: GoogleFonts.spartan(
                                  textStyle: TextStyle(
                                      fontSize: 10,
                                      fontWeight: FontWeight.w500,
                                      decoration: TextDecoration.underline),
                                  color: Color(0xFF274F50),
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                      SizedBox(
                        height: 10,
                      ),
                      Padding(
                        padding: EdgeInsets.symmetric(horizontal: 40),
                        child: MaterialButton(
                          minWidth: double.infinity,
                          height: 30,
                          onPressed: loginController.loginModel,
                          color: Color(0xFF84383A),
                          shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(40)),
                          child: Text(
                            "Sign In",
                            style: GoogleFonts.spartan(
                              textStyle: TextStyle(
                                  fontSize: 14, fontWeight: FontWeight.w500),
                              color: Colors.white,
                            ),
                          ),
                        ),
                      ),
                      SizedBox(
                        height: 10,
                      ),
                    ],
                  ),
                ),
                SizedBox(
                  height: 100,
                ),
                GestureDetector(
                  onTap: () => Get.toNamed(Routes.FORGOT_PASSWORD),
                  child: Text(
                    "Forgot your password?",
                    style: GoogleFonts.spartan(
                      textStyle: TextStyle(
                          fontSize: 10,
                          fontWeight: FontWeight.w500,
                          decoration: TextDecoration.underline),
                      color: Colors.white,
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
