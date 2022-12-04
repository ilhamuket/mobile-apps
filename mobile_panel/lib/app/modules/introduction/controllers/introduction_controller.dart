import 'package:ensiklotari/app/data/Service/network_handler.dart';
import 'package:get/get.dart';

class IntroductionController extends GetxController {
  RxString? token;
  RxBool loggedIn = false.obs;
  @override
  void onInit() {
    super.onInit();
    // checkLogin();
  }

  // void checkLogin() async {
  //   var scopedToken = await NetworkHandler.getToken();
  //   if (scopedToken != null) {
  //     token?.value = scopedToken;
  //     loggedIn.value = true;
  //     var response = await NetworkHandler.get("/api/login", scopedToken);
  //     print(response);
  //   }
  // }
}
