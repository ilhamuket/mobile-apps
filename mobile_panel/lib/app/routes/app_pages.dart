import 'package:get/get.dart';

import 'package:ensiklotari/app/modules/forgot_password/bindings/forgot_password_binding.dart';
import 'package:ensiklotari/app/modules/forgot_password/views/forgot_password_view.dart';
import 'package:ensiklotari/app/modules/home/bindings/home_binding.dart';
import 'package:ensiklotari/app/modules/home/views/home_view.dart';
import 'package:ensiklotari/app/modules/introduction/bindings/introduction_binding.dart';
import 'package:ensiklotari/app/modules/introduction/views/introduction_view.dart';
import 'package:ensiklotari/app/modules/login/bindings/login_binding.dart';
import 'package:ensiklotari/app/modules/login/views/login_view.dart';
import 'package:ensiklotari/app/modules/new_password/bindings/new_password_binding.dart';
import 'package:ensiklotari/app/modules/new_password/views/new_password_view.dart';
import 'package:ensiklotari/app/modules/profile/bindings/profile_binding.dart';
import 'package:ensiklotari/app/modules/profile/views/profile_view.dart';
import 'package:ensiklotari/app/modules/register/bindings/register_binding.dart';
import 'package:ensiklotari/app/modules/register/views/register_view.dart';
import 'package:ensiklotari/app/modules/splash_screen/bindings/splash_screen_binding.dart';
import 'package:ensiklotari/app/modules/splash_screen/views/splash_screen_view.dart';

part 'app_routes.dart';

class AppPages {
  AppPages._();

  static const INITIAL = Routes.SPLASH_SCREEN;

  static final routes = [
    GetPage(
      name: _Paths.HOME,
      page: () => HomeView(),
      binding: HomeBinding(),
    ),
    GetPage(
      name: _Paths.LOGIN,
      page: () => LoginView(),
      binding: LoginBinding(),
    ),
    GetPage(
      name: _Paths.REGISTER,
      page: () => RegisterView(),
      binding: RegisterBinding(),
    ),
    GetPage(
      name: _Paths.INTRODUCTION,
      page: () => IntroductionView(),
      binding: IntroductionBinding(),
    ),
    GetPage(
      name: _Paths.FORGOT_PASSWORD,
      page: () => ForgotPasswordView(),
      binding: ForgotPasswordBinding(),
    ),
    GetPage(
      name: _Paths.SPLASH_SCREEN,
      page: () => SplashScreenView(),
      binding: SplashScreenBinding(),
    ),
    GetPage(
      name: _Paths.NEW_PASSWORD,
      page: () => NewPasswordView(),
      binding: NewPasswordBinding(),
    ),
    GetPage(
      name: _Paths.PROFILE,
      page: () => ProfileView(),
      binding: ProfileBinding(),
    ),
  ];
}
