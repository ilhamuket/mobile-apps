import 'package:ensiklotari/app/data/ikon_ensiklotari_icons.dart';
import 'package:ensiklotari/app/routes/app_pages.dart';
import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';

import '../controllers/forgot_password_controller.dart';

// ignore: must_be_immutable
class ForgotPasswordView extends GetView<ForgotPasswordController> {
  var forgotController = Get.put(ForgotPasswordController());
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
                                controller: forgotController.emailController,
                                iconPref: Icon(IkonEnsiklotari.email),
                                hintText: "Email"),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.start,
                              children: [
                                MaterialButton(
                                  height: 20,
                                  onPressed: () {
                                    forgotController.forgotPassword();
                                  },
                                  color: Color(0xFF9DC5D1),
                                  shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(40)),
                                  child: Text(
                                    "Send an email",
                                    style: GoogleFonts.spartan(
                                      textStyle: TextStyle(
                                          fontSize: 10,
                                          fontWeight: FontWeight.w500),
                                      color: Color(0xFF2B2B2B),
                                    ),
                                  ),
                                ),
                              ],
                            ),
                            controller.makeInput(
                              iconPref: Icon(IkonEnsiklotari.password),
                              hintText: "Code",
                            ),
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
                              "check your email to gets a code",
                              style: GoogleFonts.spartan(
                                textStyle: TextStyle(
                                    fontSize: 10, fontWeight: FontWeight.w500),
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
                          onPressed: () {
                            Get.toNamed(Routes.NEW_PASSWORD);
                          },
                          color: Color(0xFF84383A),
                          shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(40)),
                          child: Text(
                            "Submit",
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
                  onTap: () => Get.toNamed(Routes.LOGIN),
                  child: Container(
                    width: 35,
                    child: Image(
                      image: AssetImage("assets/images/arrow.png"),
                      fit: BoxFit.fill,
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
