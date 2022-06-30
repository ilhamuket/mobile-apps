import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';

import '../controllers/introduction_controller.dart';

class IntroductionView extends GetView<IntroductionController> {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Container(
        decoration: const BoxDecoration(
          image: DecorationImage(
              image: AssetImage("assets/images/background.png"),
              fit: BoxFit.fill),
        ),
        child: Container(
          width: double.infinity,
          height: MediaQuery.of(context).size.height,
          padding: EdgeInsets.symmetric(horizontal: 20, vertical: 20),
          decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.center,
              end: Alignment.bottomCenter,
              colors: [
                Colors.black12,
                Colors.black87,
              ],
            ),
          ),
          child: Scaffold(
            backgroundColor: Colors.transparent,
            body: Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                SizedBox(
                  height: 150,
                ),
                Image(
                  image: AssetImage("assets/images/ensiklotari.png"),
                ),
                SizedBox(
                  height: 60,
                ),
                MaterialButton(
                  minWidth: double.infinity,
                  height: 35,
                  onPressed: () {},
                  color: Color(0xFFD9D9D9).withOpacity(0.4),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(40)),
                  child: Text(
                    "Sign In",
                    style: GoogleFonts.spartan(
                      textStyle:
                          TextStyle(fontSize: 14, fontWeight: FontWeight.w500),
                      color: Colors.white,
                    ),
                  ),
                ),
                MaterialButton(
                  minWidth: double.infinity,
                  height: 35,
                  onPressed: () {},
                  color: Color(0xFF9DC5D1),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(40)),
                  child: Text(
                    "Sign Up",
                    style: GoogleFonts.spartan(
                      textStyle:
                          TextStyle(fontSize: 14, fontWeight: FontWeight.w500),
                      color: Color(0xFF2B2B2B),
                    ),
                  ),
                ),
                SizedBox(
                  height: 140,
                ),
                Text(
                  "Let’s dance to rhytm of live",
                  style: GoogleFonts.spartan(
                    textStyle:
                        TextStyle(fontSize: 17, fontWeight: FontWeight.bold),
                    color: Color(0xFF9DC5D1),
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
