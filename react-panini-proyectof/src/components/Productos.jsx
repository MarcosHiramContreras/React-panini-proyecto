import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const Productoss = () => {
    const [newProduct, setNewProduct] = useState({
        id_producto: '',
        nom_producto: '',
        marca: '',
        categoria: '',
        stock: '',
        precio_compra: '',
        precio_venta: ''
    });
};

export default Productoss;
