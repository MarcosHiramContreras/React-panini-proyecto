import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const Ventass = () => {
    const [newPedido, setNewPedido] = useState({
        id_pedido: '',
        fecha_pedido: '',
        id_producto: '',
        id_proveedor: '',
        cantidad_solicitada: '',
        estado: '',
        fecha_surtido: '',
        costo_pedido: ''
    });

   
};

export default Ventass;
