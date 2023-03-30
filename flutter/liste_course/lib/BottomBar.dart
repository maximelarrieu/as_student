import 'package:flutter/material.dart';
import 'package:liste_course/ListeController.dart';
import 'package:liste_course/TotalController.dart';
import 'package:liste_course/product.dart';

class BottomBar extends StatefulWidget {
  @override
  _BottomBarState createState() => _BottomBarState();
}

class _BottomBarState extends State<BottomBar> {
  int _selectedIndex = 0;
  final List<Widget> _children = [ListeController(), TotalController()];

  void _onItemTapped(int index) {
    setState(() {
      _selectedIndex = index;
      print(index);
    });
  }

  @override
  Widget build(BuildContext context) {
    // final alreadySaved = _saved.contains(products);
    return BottomAppBar(
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: [
          FlatButton(
            child: Icon(Icons.list),
            onPressed: () {
              Navigator.push(context,
                  MaterialPageRoute(builder: (BuildContext buildContext) {
                return ListeController();
              }));
            },
          ),
          FlatButton(
            child: Icon(Icons.euro),
            onPressed: () {
              Navigator.push(context,
                  MaterialPageRoute(builder: (BuildContext buildContext) {
                return TotalController();
              }));
            },
          ),
        ],
      ),
      // currentIndex: _selectedIndex,
      // selectedItemColor: Colors.amber[800],
      // onTap: _onItemTapped,
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
