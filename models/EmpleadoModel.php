<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class EmpleadoModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $codigo;
    private $nombre;

    private $cod_depto;

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo)
    {
        return $this->codigo = $codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        return $this->nombre = $nombre;
    }

    public function getCod_depto()
    {
        return $this->cod_depto;
    }

    public function setCod_depto($cod_depto)
    {
        return $this->cod_depto = $cod_depto;
    }

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM EMPLEADO ORDER BY 1');
        $consulta->execute();
        
        // OJO!! El fetchAll() funcionará correctamente siempre que el nombre
        // de los atributos de la clase coincida con los campos de la tabla
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "EmpleadoModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($codigo)
    {
        $gsent = $this->db->prepare('SELECT * FROM EMPLEADO WHERE codigo = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "EmpleadoModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->codigo)) {
            $consulta = $this->db->prepare('INSERT INTO EMPLEADO(nombre,cod_depto) VALUES (?,?)');
            $consulta->bindParam(1, $this->nombre);
            $consulta->bindParam(2, $this->cod_depto);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE EMPLEADO SET nombre=?, cod_depto=? WHERE codigo=?');
            $consulta->bindParam(1, $this->nombre);
            $consulta->bindParam(2, $this->cod_depto);
            $consulta->bindParam(3, $this->codigo);
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM EMPLEADO WHERE codigo=?');
        $consulta->bindParam(1, $this->codigo);
        $consulta->execute();
    }

    // Método para obtener la descripción del departamento al que pertenece el empleado
    public function getDepartamentoDescripcion() {
        $consulta = $this->db->prepare('SELECT nombre FROM DEPARTAMENTO WHERE codigo = ?');
        $consulta->bindParam(1,$this->cod_depto);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['nombre'] : null;
    }
}
?>