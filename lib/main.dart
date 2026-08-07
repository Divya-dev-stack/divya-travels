import 'package:flutter/material.dart';

void main() {
  runApp(const DivyaTravelsApp());
}

class DivyaTravelsApp extends StatelessWidget {
  const DivyaTravelsApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Divya Travels',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF0B5ED7),
        ),
        useMaterial3: true,
        fontFamily: 'Arial',
      ),
      home: const HomePage(),
    );
  }
}

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
        title: const Text(
          'DIVYA TRAVELS',
          style: TextStyle(
            fontWeight: FontWeight.bold,
            color: Color(0xFF0B5ED7),
            fontSize: 22,
          ),
        ),
        actions: [
          TextButton(
            onPressed: () {},
            child: const Text('Home'),
          ),
          TextButton(
            onPressed: () {},
            child: const Text('Packages'),
          ),
          TextButton(
            onPressed: () {},
            child: const Text('Contact'),
          ),
        ],
      ),

      body: SingleChildScrollView(
        child: Column(
          children: [
            // HERO SECTION
            Container(
              width: double.infinity,
              padding: const EdgeInsets.symmetric(
                horizontal: 24,
                vertical: 55,
              ),
              decoration: const BoxDecoration(
                gradient: LinearGradient(
                  colors: [
                    Color(0xFF0B5ED7),
                    Color(0xFF36A9E1),
                  ],
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                ),
              ),
              child: Column(
                children: [
                  const Text(
                    'Explore the World with',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 28,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                  const SizedBox(height: 8),
                  const Text(
                    'DIVYA TRAVELS',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 38,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 15),
                  const Text(
                    'Your journey begins here',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 18,
                    ),
                  ),
                  const SizedBox(height: 30),

                  ElevatedButton(
                    onPressed: () {},
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.white,
                      foregroundColor: const Color(0xFF0B5ED7),
                      padding: const EdgeInsets.symmetric(
                        horizontal: 35,
                        vertical: 16,
                      ),
                    ),
                    child: const Text(
                      'Explore Packages',
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ],
              ),
            ),

            // SEARCH SECTION
            Padding(
              padding: const EdgeInsets.all(20),
              child: Card(
                elevation: 5,
                child: Padding(
                  padding: const EdgeInsets.all(20),
                  child: Column(
                    children: [
                      const Text(
                        'Find Your Perfect Trip',
                        style: TextStyle(
                          fontSize: 22,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 20),

                      TextField(
                        decoration: InputDecoration(
                          labelText: 'Where do you want to go?',
                          prefixIcon: const Icon(Icons.location_on),
                          border: OutlineInputBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                      ),

                      const SizedBox(height: 15),

                      SizedBox(
                        width: double.infinity,
                        child: ElevatedButton.icon(
                          onPressed: () {},
                          icon: const Icon(Icons.search),
                          label: const Text('Search Trips'),
                          style: ElevatedButton.styleFrom(
                            padding: const EdgeInsets.symmetric(
                              vertical: 15,
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),

            // POPULAR DESTINATIONS
            const Padding(
              padding: EdgeInsets.only(
                left: 20,
                right: 20,
                top: 20,
                bottom: 10,
              ),
              child: Align(
                alignment: Alignment.centerLeft,
                child: Text(
                  'Popular Destinations',
                  style: TextStyle(
                    fontSize: 25,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ),

            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 20),
              child: Wrap(
                spacing: 12,
                runSpacing: 12,
                children: const [
                  DestinationCard(
                    name: 'Goa',
                    icon: Icons.beach_access,
                  ),
                  DestinationCard(
                    name: 'Kerala',
                    icon: Icons.landscape,
                  ),
                  DestinationCard(
                    name: 'Ooty',
                    icon: Icons.park,
                  ),
                  DestinationCard(
                    name: 'Dubai',
                    icon: Icons.flight,
                  ),
                ],
              ),
            ),

            const SizedBox(height: 30),

            // PACKAGES
            const Padding(
              padding: EdgeInsets.symmetric(horizontal: 20),
              child: Align(
                alignment: Alignment.centerLeft,
                child: Text(
                  'Featured Tour Packages',
                  style: TextStyle(
                    fontSize: 25,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ),

            const SizedBox(height: 15),

            const PackageCard(
              title: 'Kerala Family Tour',
              duration: '5 Days / 4 Nights',
              price: '₹18,999',
              icon: Icons.family_restroom,
            ),

            const PackageCard(
              title: 'Goa Beach Holiday',
              duration: '4 Days / 3 Nights',
              price: '₹14,999',
              icon: Icons.beach_access,
            ),

            const PackageCard(
              title: 'Dubai Special Tour',
              duration: '6 Days / 5 Nights',
              price: '₹49,999',
              icon: Icons.flight_takeoff,
            ),

            const SizedBox(height: 30),

            // WHY CHOOSE US
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(25),
              color: const Color(0xFFF4F7FB),
              child: Column(
                children: [
                  const Text(
                    'Why Choose Divya Travels?',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      fontSize: 25,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 20),

                  const FeatureItem(
                    icon: Icons.verified,
                    title: 'Trusted Service',
                    description: 'Reliable travel support for every journey.',
                  ),

                  const FeatureItem(
                    icon: Icons.support_agent,
                    title: '24/7 Support',
                    description: 'We are always available to help you.',
                  ),

                  const FeatureItem(
                    icon: Icons.currency_rupee,
                    title: 'Best Prices',
                    description: 'Affordable packages for every budget.',
                  ),
                ],
              ),
            ),

            // CONTACT
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(30),
              color: const Color(0xFF0B5ED7),
              child: Column(
                children: [
                  const Text(
                    'Ready to Travel?',
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 28,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 10),
                  const Text(
                    'Contact Divya Travels today',
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 17,
                    ),
                  ),
                  const SizedBox(height: 20),

                  ElevatedButton.icon(
                    onPressed: () {},
                    icon: const Icon(Icons.phone),
                    label: const Text('Contact Us'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.white,
                      foregroundColor: const Color(0xFF0B5ED7),
                      padding: const EdgeInsets.symmetric(
                        horizontal: 30,
                        vertical: 15,
                      ),
                    ),
                  ),
                ],
              ),
            ),

            const Padding(
              padding: EdgeInsets.all(20),
              child: Text(
                '© 2026 Divya Travels. All Rights Reserved.',
                textAlign: TextAlign.center,
              ),
            ),
          ],
        ),
      ),
    );
  }
}

// DESTINATION CARD
class DestinationCard extends StatelessWidget {
  final String name;
  final IconData icon;

  const DestinationCard({
    super.key,
    required this.name,
    required this.icon,
  });

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: 150,
      child: Card(
        elevation: 3,
        child: Padding(
          padding: const EdgeInsets.all(20),
          child: Column(
            children: [
              Icon(
                icon,
                size: 45,
                color: const Color(0xFF0B5ED7),
              ),
              const SizedBox(height: 10),
              Text(
                name,
                style: const TextStyle(
                  fontSize: 17,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

// PACKAGE CARD
class PackageCard extends StatelessWidget {
  final String title;
  final String duration;
  final String price;
  final IconData icon;

  const PackageCard({
    super.key,
    required this.title,
    required this.duration,
    required this.price,
    required this.icon,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.symmetric(
        horizontal: 20,
        vertical: 8,
      ),
      elevation: 3,
      child: Padding(
        padding: const EdgeInsets.all(18),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(15),
              decoration: BoxDecoration(
                color: const Color(0xFFE8F1FF),
                borderRadius: BorderRadius.circular(12),
              ),
              child: Icon(
                icon,
                size: 35,
                color: const Color(0xFF0B5ED7),
              ),
            ),

            const SizedBox(width: 15),

            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 5),
                  Text(duration),
                  const SizedBox(height: 5),
                  Text(
                    price,
                    style: const TextStyle(
                      color: Color(0xFF0B5ED7),
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
            ),

            ElevatedButton(
              onPressed: () {},
              child: const Text('Book'),
            ),
          ],
        ),
      ),
    );
  }
}

// FEATURE ITEM
class FeatureItem extends StatelessWidget {
  final IconData icon;
  final String title;
  final String description;

  const FeatureItem({
    super.key,
    required this.icon,
    required this.title,
    required this.description,
  });

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 10),
      child: Row(
        children: [
          Icon(
            icon,
            size: 35,
            color: const Color(0xFF0B5ED7),
          ),
          const SizedBox(width: 15),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
                  style: const TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Text(description),
              ],
            ),
          ),
        ],
      ),
    );
  }
}