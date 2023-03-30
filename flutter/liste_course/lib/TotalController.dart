import 'package:flutter/material.dart';
import 'package:liste_course/BottomBar.dart';
import 'package:liste_course/product.dart';

class TotalController extends StatefulWidget {
  @override
  _TotalController createState() => _TotalController();
}

class _TotalController extends State<TotalController> {
  List<Product> products = [
    Product(name: 'Tomate', price: 5),
    Product(name: 'Poire', price: 5),
    Product(name: 'Salade', price: 5),
    Product(name: 'Carotte', price: 5),
    Product(name: 'Pomme', price: 5),
    Product(name: 'Aubergine', price: 5),
    Product(name: 'COncombre', price: 5),
    Product(name: 'Tomate', price: 5),
  ];
  final _saved = Set<Product>();

  @override
  Widget build(BuildContext context) {
    // final alreadySaved = _saved.contains(products);
    return Scaffold(
      appBar: AppBar(
        title: Text("Ma liste de course"),
      ),
      body: Container(
        child: Text("TOTAL"),
      ),
      bottomNavigationBar: BottomBar(),
    );
  }
}
