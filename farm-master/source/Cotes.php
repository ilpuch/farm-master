<?php


namespace AChivkin\Farm\source;

/**
 * Родительский класс для всех хлевов фермы
 */
class Cotes
{
    /**
     * @var array $animalsList массив объектов зарегистрированных животных
     */
    public $animalsList = [];
    /**
     * @var array $products массив собранной продукции
     */
    public $products = [];

    /**
     * Метод регистрации животных в хлеве.
     *
     * Перебирает массив с животными, создавая для каждого объект.
     * Записывет массив с объектами зарегистрированных(с присвоенными ID) животных в свойство.
     *
     * @param array $listAnimals Список всех животных в хлеве,
     * где индекс массива - название животных, значение - количество животных.
     *
     * @return void
     */

    public function registerAnimals(array $listAnimals): void
    {
        foreach ($listAnimals as $name => $amount) {  // cHiCkEn
            $animalLowercaseName = strtolower($name); // приводим к нижнему регистру всю строчку chicken
            $className = ucfirst($animalLowercaseName); // приводит первый симовол строки к верхнему регистру Chicken
            $className = __NAMESPACE__ . '\\' . $className;  //определяем класс животного  'AChivkin\\Farm\\source\\Chicken'
            for ($i = 1; $i <= $amount; $i++) {
                $this->animalsList[$animalLowercaseName][] = new $className();  // создаем  новый элемент с ключом животного + создается еще один массив
            }
        }
    }

    /**
     * Метод сбора продукции.
     *
     * Перебирает массив с объектами зарегистрированных животных,
     * вызывая у каждого метод сбора продукции.
     *
     * Суммирует продукцию и записывает данные в массив,
     * где индекс массива - вид собранной продукции, значение - количество.
     *
     * @return void
     */
    public function collectProducts(): void
    {
        foreach ($this->animalsList as $key => $animals) {
            $product = 0;
            /** @var Animal $animal */
            foreach ($animals as $animal) {
                $product += $animal->getProducts();
            }
            $this->products["$key"] = $product;
        }
    }
}