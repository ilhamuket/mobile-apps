import 'package:ensiklotari/app/modules/login/controllers/login_controller.dart';
import 'package:ensiklotari/app/routes/app_pages.dart';
import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';

import '../../../data/ikon_ensiklotari_icons.dart';
import '../controllers/register_controller.dart';

class RegisterView extends GetView<RegisterController> {
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Color(0xFF84383A),
      body: Center(
        child: Column(
          children: [
            Container(
              padding: EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.vertical(
                  bottom: Radius.circular(35),
                ),
              ),
              // height: MediaQuery.of(context).size.height,
              width: double.infinity,
              child: Column(
                children: [
                  SizedBox(
                    height: 40,
                  ),
                  Text(
                    "Create an account",
                    style: GoogleFonts.spartan(
                      textStyle:
                          TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    ),
                  ),
                  SizedBox(
                    height: 20,
                  ),
                  Padding(
                    padding: EdgeInsets.symmetric(horizontal: 15),
                    child: Column(
                      children: [
                        controller.makeInput(
                            iconPref: Icon(IkonEnsiklotari.profile),
                            hintText: "Name"),
                        controller.makeInput(
                            iconPref: Icon(IkonEnsiklotari.email),
                            hintText: "Email"),
                        controller.makeInput(
                            iconPref: Icon(IkonEnsiklotari.password),
                            hintText: "Password",
                            obsureText: true),
                        controller.makeInput(
                            iconPref: Icon(IkonEnsiklotari.password),
                            hintText: "Re-enter password",
                            obsureText: true),
                      ],
                    ),
                  ),
                  SizedBox(
                    height: 20,
                  ),
                  Padding(
                    padding: EdgeInsets.symmetric(horizontal: 15),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.end,
                      children: [
                        Text(
                          "Already have an account? ",
                          style: GoogleFonts.spartan(
                            textStyle: TextStyle(
                                fontSize: 10, fontWeight: FontWeight.w500),
                          ),
                        ),
                        GestureDetector(
                          onTap: () => Get.toNamed(Routes.LOGIN),
                          child: Text(
                            "Sign In",
                            style: GoogleFonts.spartan(
                              textStyle: TextStyle(
                                  fontSize: 10,
                                  fontWeight: FontWeight.w500,
                                  decoration: TextDecoration.underline),
                              color: Color(0xFF84383A),
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
                      onPressed: () {},
                      color: Color(0xFF84383A),
                      shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(40)),
                      child: Text(
                        "Sign Up",
                        style: GoogleFonts.spartan(
                          textStyle: TextStyle(
                              fontSize: 14, fontWeight: FontWeight.w500),
                          color: Colors.white,
                        ),
                      ),
                    ),
                  ),
                  SizedBox(
                    height: 20,
                  ),
                  Text(
                    "Or",
                    style: GoogleFonts.spartan(
                      textStyle:
                          TextStyle(fontSize: 10, fontWeight: FontWeight.w500),
                    ),
                  ),
                  SizedBox(
                    height: 20,
                  ),
                  Container(
                    width: 25,
                    child: Image(
                      image: AssetImage("assets/images/google.png"),
                      fit: BoxFit.fill,
                    ),
                  ),
                ],
              ),
            ),
            SizedBox(
              height: 50,
            ),
            Container(
              child: Image(
                height: 40,
                image: AssetImage("assets/images/ensiklotari.png"),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
