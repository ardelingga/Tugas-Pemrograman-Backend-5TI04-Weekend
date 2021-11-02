<!-- Created by : Ardelingga Pramesta Kusum - 0110219030 -->

<!-- Tugas Membuat Class Animal -->

<?php
class Animal
{
    public $animals;

    public function __construct($data)
    {
        $this->animals = $data;
    }

    public function index()
    {
        foreach ($this->animals as $i => $value) {
            echo $value . "\n";
        }
    }

    public function store($data)
    {
        array_push($this->animals, $data);
    }

    public function update($index, $data)
    {
        $this->animals[$index] = $data;
    }
    public function destroy($index)
    {
        unset($this->animals[$index]);
    }
}

$data = ['Kelinci', 'Ayam', 'Kambing', 'Sapi', 'Unta'];
$animal = new Animal($data);

echo "INDEX - Menampilkan seluruh hewan : \n";
$animal->index();
echo "\n";

echo "STORE - Menambahkan hewan baru (GAJAH) : \n";
$animal->store('Gajah');
$animal->index();
echo "\n";

echo "UPDATE - Mengupdate hewan : \n";
$animal->update(1, 'Buaya');
$animal->index();
echo "\n";

echo "DESTROY - Menghapus hewan : \n";
$animal->destroy(1);
$animal->index();
echo "\n";


?>
