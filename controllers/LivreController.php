<?php
class LivreController
{
    private $livre;

    public function __construct()
    {
        global $conn;
        $this->livre = new Livre($conn);
    }

    public function index()
    {
        return $this->livre->all();
    }

    public function store($titre, $auteur)
    {
        $this->livre->create($titre, $auteur);
        header('Location: index.php');
        exit;
    }

    public function edit($id)
    {
        return $this->livre->findId($id);
    }

    public function update($id, $titre, $auteur)
    {
        $this->livre->update($id, $titre, $auteur);
        header('Location: index.php');
        exit;
    }

    public function destroy($id)
    {
        $this->livre->delete($id);
        header('Location: index.php');
        exit;
    }
}
