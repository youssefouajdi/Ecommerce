<?php
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Category::create([
                'name'=>'SuperMarche',
                'slug'=>'SuperMarche']);
      Category::create([
          'name'=>'Maison Bureau',
          'slug'=>'Maison Bureau']);
      Category::create([
          'name'=>'Beate & Sante',
          'slug'=>'Beate & Sante']);
      Category::create([
          'name'=>'Sport et Loisir',
          'slug'=>'Sport et Loisir']);
      Category::create([
          'name'=>'Tv & Electronique',
          'slug'=>'Tv & Electronique']);
      Category::create([
          'name'=>'Informatique',
          'slug'=>'Informatique']);
      Category::create([
          'name'=>'Vetement & Chaussure',
          'slug'=>'Vetement & Chaussure']);
      Category::create([
          'name'=>'Telephone & tablette',
          'slug'=>'Telephone & tablette']);
      Category::create([
          'name'=>'Autre',
          'slug'=>'Autre']); 
    }
}
