import 'package:ensiklotari/app/modules/login/controllers/login_controller.dart';
import 'package:ensiklotari/app/routes/app_pages.dart';
import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

import 'package:get/get.dart';

import '../controllers/register_controller.dart';

class RegisterView extends GetView<RegisterController> {
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Center(
          child: Padding(
            padding: const EdgeInsets.all(20),
            child: Form(
              key: _formKey,
              child: Column(
                children: [
                  SvgPicture.asset(
                    "assets/login.svg",
                    width: 150,
                  ),
                  SizedBox(
                    height: 20,
                  ),
                  TextForm(
                    obs: false,
                    label: "username",
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  TextForm(
                    obs: false,
                    label: "phone number",
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  TextForm(
                    obs: false,
                    label: "email",
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  TextForm(
                    obs: true,
                    label: "password",
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  Text.rich(
                    TextSpan(
                      text: "Already Have account?",
                      children: [
                        TextSpan(
                          text: " Login",
                          recognizer: TapGestureRecognizer()
                            ..onTap = () {
                              Get.offAllNamed(Routes.LOGIN);
                            },
                          style: TextStyle(color: Colors.blue),
                        ),
                      ],
                    ),
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  Container(
                    width: MediaQuery.of(context).size.width,
                    child: ElevatedButton(
                      onPressed: () {
                        if (_formKey.currentState!.validate()) {
                          print("berhasil");
                        }
                      },
                      child: Text("Register"),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
