<?php

namespace Database\Seeders;

use App\Models\Sector;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tab = [
            " Python",
            "Java",
            "C++",
            "JavaScript",
            "Ruby",
            "C#",
            "PHP",
            "Swift (pour le développement iOS)",
            "Kotlin (pour le développement Android)",
            "Objective-C (pour le développement iOS)",
            "TypeScript",
            "Go",
            "Rust",
            "Django (Python)",
            "Flask (Python)",
            "Spring (Java)",
            "React (JavaScript)",
            "Angular (JavaScript/TypeScript)",
            "Vue.js (JavaScript)",
            "Ruby on Rails (Ruby)",
            ".NET Core (C#)",
            "Laravel (PHP)",
            "Design Patterns",
            "Principes SOLID",
            "Architecture MVC, MVP, MVVM",
            "Microservices",
            "Clean Architecture",
            "SQL (MySQL, PostgreSQL, SQL Server, Oracle, etc.)",
            "NoSQL (MongoDB, Cassandra, Redis, etc.)",
            "Android : Android Studio, Kotlin, Java, Jetpack, Android SDK",
            "iOS : Xcode, Swift, Objective-C, SwiftUI, UIKit, Core Data, etc",
        ];

        foreach ($tab as $item) {
            Skill::updateOrCreate(
                [
                    'name' => $item
                ],
                [
                    'name' => $item
                ],
            );

        }
    }
}
