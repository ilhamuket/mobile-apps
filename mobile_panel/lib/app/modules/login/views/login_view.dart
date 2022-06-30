import 'package:ensiklotari/app/data/Service/api.dart';
import 'package:ensiklotari/app/data/models/ikon_icons.dart';
import 'package:ensiklotari/app/routes/app_pages.dart';
import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';

import '../controllers/login_controller.dart';

class LoginView extends GetView<LoginController> {
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  ApiService _apiService = ApiService();

  TextEditingController emailController = TextEditingController();
  TextEditingController passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Color(0xFF84383A),
      body: SafeArea(
        child: Center(
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
                    Text(
                      "Create an account",
                      style: GoogleFonts.spartan(
                        textStyle: TextStyle(
                            fontSize: 18, fontWeight: FontWeight.bold),
                      ),
                    ),
                    SizedBox(
                      height: 20,
                    ),
                    Padding(
                      padding: EdgeInsets.symmetric(horizontal: 15),
                      child: Column(
                        children: [
                          controller.makeInput(hintText: "Name"),
                          controller.makeInput(hintText: "Email"),
                          controller.makeInput(
                              hintText: "Password", obsureText: true),
                          controller.makeInput(
                              hintText: "Re-enter password", obsureText: true),
                        ],
                      ),
                    ),
                    SizedBox(
                      height: 20,
                    ),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.end,
                      children: [
                        Text(
                          "Already have an account? ",
                          style: GoogleFonts.spartan(
                            textStyle: TextStyle(
                                fontSize: 12, fontWeight: FontWeight.w500),
                          ),
                        ),
                        Text(
                          "Sign In",
                          style: GoogleFonts.spartan(
                            textStyle: TextStyle(
                                fontSize: 12,
                                fontWeight: FontWeight.w500,
                                decoration: TextDecoration.underline),
                            color: Color(0xFF84383A),
                          ),
                        ),
                      ],
                    ),
                    SizedBox(
                      height: 20,
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
                        textStyle: TextStyle(
                            fontSize: 12, fontWeight: FontWeight.w500),
                      ),
                    ),
                    SizedBox(
                      height: 20,
                    ),
                    IconButton(
                      onPressed: () {},
                      icon: Icon(Ikon.profile),
                    ),
                  ],
                ),
              ),
              SizedBox(
                height: 30,
              ),
              Container(
                child: Image(
                  image: AssetImage("assets/images/ensiklotari.png"),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
