import 'package:flutter/material.dart';
import 'package:liste_course/BottomBar.dart';
import 'package:liste_course/product.dart';

class ListeController extends StatefulWidget {
  ListeController({Key key, this.title}) : super(key: key);
  final String title;

  @override
  _ListeControllerState createState() => _ListeControllerState();
}

class _ListeControllerState extends State<ListeController> {
  List<Product> products = [
    Product(name: 'Tomate', price: 5),
    Product(name: 'Tomate', price: 5),
    Product(name: 'Tomate', price: 5),
    Product(name: 'Tomate', price: 5),
    Product(name: 'Tomate', price: 5),
    Product(name: 'Tomate', price: 5),
    Product(name: 'Tomate', price: 5),
    Product(name: 'Tomate', price: 5),
  ];
  bool checked = false;
  int _selectedIndex = 0;
  final _saved = Set<Product>();

  @override
  Widget build(BuildContext context) {
    // final alreadySaved = _saved.contains(products);
    return Scaffold(
      appBar: AppBar(
        title: Text("Ma liste de course"),
      ),
      body: ListView.builder(
          itemCount: products.length,
          itemBuilder: (context, index) {
            return Padding(
                padding: EdgeInsets.symmetric(vertical: 10.0, horizontal: 10.0),
                child: Column(
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceAround,
                      children: [
                        Text(products[index].name),
                        Text(products[index].price.toString() + " €"),
                        Checkbox(
                            value: checked,
                            onChanged: (bool value) {
                              setState(() {
                                checked = value;
                              });
                            })
                        // Icon(
                        //   alreadySaved
                        //       ? Icons.favorite
                        //       : Icons.favorite_border,
                        //   color: alreadySaved ? Colors.red : null,
                        // )
                      ],
                    )
                  ],
                ));
          }),
      bottomNavigationBar: BottomBar(),
    );
  }

// class _ListeControllerState extends State<ListeController> {

//   }

  // @override
  // Widget build(BuildContext context) {
  //   return Scaffold(
  //       appBar: AppBar(
  //         title: const Text('BottomNavigationBar Sample'),
  //       ),
  //       body: Center(child: RandomWords()),
  //       bottomNavigationBar: BottomNavigationBar(
  //         items: const <BottomNavigationBarItem>[
  //           BottomNavigationBarItem(
  //             icon: Icon(Icons.list),
  //             label: 'Ma liste',
  //           ),
  //           BottomNavigationBarItem(
  //             icon: Icon(Icons.euro),
  //             label: 'Total',
  //           ),
  //         ],
  //         currentIndex: _selectedIndex,
  //         selectedItemColor: Colors.amber[800],
  //         onTap: _onItemTapped,
  //       ));
  // }

}
