import 'package:ensiklotari/app/data/Service/api.dart';
import 'package:ensiklotari/app/routes/app_pages.dart';
import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

import 'package:get/get.dart';

import '../controllers/login_controller.dart';

class LoginView extends GetView<LoginController> {
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  ApiService _apiService = ApiService();

  TextEditingController emailController = TextEditingController();
  TextEditingController passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Center(
          child: Container(
            height: MediaQuery.of(context).size.height,
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
                      controller: emailController,
                      obs: false,
                      label: "email",
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    TextForm(
                      controller: passwordController,
                      obs: true,
                      label: "password",
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    Text.rich(
                      TextSpan(
                        text: "Dont Have account?",
                        children: [
                          TextSpan(
                            text: " Register",
                            recognizer: TapGestureRecognizer()
                              ..onTap = () {
                                Get.offAllNamed(Routes.REGISTER);
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
                            _apiService
                                .postLogin(emailController.text,
                                    passwordController.text)
                                .then((value) => {
                                      if (value != null)
                                        {print("masuk ke home")}
                                    });
                          }
                        },
                        child: Text("LOGIN"),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
