import 'package:flutter/material.dart';
import 'package:get/get.dart';

class LoginController extends GetxController {}

class TextForm extends StatelessWidget {
  final TextEditingController? controller;
  final bool? obs;
  final String? label;
  const TextForm({
    this.controller,
    this.obs,
    this.label,
    Key? key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return TextFormField(
      controller: controller,
      validator: (value) {
        if (value!.isEmpty) {
          return "harus diisi";
        } else {
          return null;
        }
      },
      obscureText: obs ?? false,
      decoration: InputDecoration(
        border: OutlineInputBorder(),
        labelText: label,
      ),
    );
  }
}
