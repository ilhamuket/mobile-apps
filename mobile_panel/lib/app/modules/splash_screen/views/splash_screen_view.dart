import 'package:flutter/material.dart';

import 'package:get/get.dart';

import '../controllers/splash_screen_controller.dart';

class SplashScreenView extends GetView<SplashScreenController> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xFF84383A),
      body: SafeArea(
        child: Center(
          child: Container(
            child: Image(
              image: AssetImage("assets/images/ensiklotari.png"),
            ),
          ),
        ),
      ),
    );
  }
}
