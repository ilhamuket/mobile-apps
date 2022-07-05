import 'package:http/http.dart' as http;
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class NetworkHandler {
  static final client = http.Client();
  static final storage = FlutterSecureStorage();
  static Future<String> post(var body, String endpoint) async {
    var response = await client.post(buildUrl(endpoint), body: body, headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    });
    return response.body;
  }

  static Future<dynamic> get(String endpoint, String? token) async {
    var response = await client.get(buildUrl(endpoint), headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': 'Bearer $token',
    });
    return response.body;
  }

  static Uri buildUrl(String endpoint) {
    String host = "https://api.ensiklotari.com/v1/auth/";
    final apiPath = host + endpoint;
    return Uri.parse(apiPath);
  }

  static Future<void> storeToken(String token) async {
    await storage.write(key: "token", value: token);
  }

  static Future<String?> getToken() async {
    return await storage.read(key: "token");
  }
}
