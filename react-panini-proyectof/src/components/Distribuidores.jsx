import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { datos } from '../api/GetProveedor'; // Importa los datos iniciales

const NuevoProveedorForm = () => {
    const [newProveedor, setNewProveedor] = useState({
        id_proveedor: '', // El ID se generará automáticamente
        nom_proveedor: '',
        telefono: '',
        direccion: '',
        email: ''
    });

    const navigate = useNavigate();

    const handleChange = (e) => {
        const { name, value } = e.target;
        setNewProveedor({ ...newProveedor, [name]: value });
    };

    const generateUniqueID = () => {
        let newID;
        do {
            newID = Math.floor(Math.random() * 1000); // Generar un ID aleatorio entre 0 y 999
        } while (datos.some(proveedor => proveedor.id_proveedor === newID));
        return newID;
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const newID = generateUniqueID();
        const newProvider = { ...newProveedor, id_proveedor: newID };
        datos.push(newProvider); // Agregar el nuevo proveedor a la lista de datos
        alert('Proveedor agregado con éxito');
        navigate('/proveedores');
    };

    return (
        <form onSubmit={handleSubmit}>
            <div class="w3-left-align"><h1>Nuevo proveedor</h1></div><br></br>
            <input className='w3-input' name="nom_proveedor" value={newProveedor.nom_proveedor} onChange={handleChange} placeholder="Nombre del proveedor" required /><br></br>
            <input className='w3-input' name="telefono" type='number' value={newProveedor.telefono} onChange={handleChange} placeholder="Telefono" required /><br></br>
            <input className='w3-input' name="direccion" value={newProveedor.direccion} onChange={handleChange} placeholder="Direccion" required /><br></br>
            <input className='w3-input' name="email" value={newProveedor.email} onChange={handleChange} placeholder="Email" required /><br></br>
            <button className='w3-button w3-blue w3-block w3-hover-light-blue' type="submit">Agregar Proveedor</button>
        </form>
    );
};

export default NuevoProveedorForm;
