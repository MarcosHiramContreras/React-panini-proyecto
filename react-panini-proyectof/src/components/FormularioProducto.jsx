import React, { useState, useEffect } from 'react';

const FormularioProducto = () => {
    const [nombre, setNombre] = useState('');
    const [categoria, setCategoria] = useState('');
    const [descripcion, setDescripcion] = useState('');
    const [stock, setStock] = useState('');
    const [precio, setPrecio] = useState('');
    const [productos, setProductos] = useState([]);
    const [mensaje, setMensaje] = useState('');
    const [modoEdicion, setModoEdicion] = useState(false);
    const [productoEditar, setProductoEditar] = useState(null);

    useEffect(() => {
        cargarProductos();
    }, []); // Se ejecuta solo una vez al montar el componente

    const cargarProductos = () => {
        fetch('http://localhost/backend/listarproductos.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Verifica la respuesta del servidor en la consola
                setProductos(data); // Actualiza el estado de productos con los datos recibidos
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };

    const handleSubmit = (event) => {
        event.preventDefault();
    
        const producto = {
            id: productoEditar ? productoEditar.id : null,
            nombre,
            categoria,
            descripcion,
            stock: parseInt(stock),
            precio: parseFloat(precio),
        };
    
        const url = modoEdicion ? 'http://localhost/backend/modificarproducto.php' : 'http://localhost/backend/insertarproducto.php';
    
        fetch(url, {
            method: modoEdicion ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(producto),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            if (data.message === (modoEdicion ? 'Producto actualizado correctamente' : 'Producto insertado correctamente')) {
                setMensaje(`Producto ${data.id} ${modoEdicion ? 'actualizado' : 'insertado'} correctamente.`);
                cargarProductos();
                cancelarEdicion();
            } else {
                setMensaje(`Error al intentar ${modoEdicion ? 'actualizar' : 'guardar'} el producto.`);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            setMensaje('Error en la conexión o servidor.');
        });
    };

    const handleEliminarProducto = (id) => {
        fetch(`http://localhost/backend/eliminarproducto.php?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Verifica la respuesta del servidor en la consola
            
            if (data.message === 'Producto eliminado correctamente') {
                setMensaje(`Producto con ID ${id} eliminado correctamente.`);
                cargarProductos(); // Vuelve a cargar la lista de productos después de eliminar uno
            } else {
                setMensaje('Error al intentar eliminar el producto.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            setMensaje('Error en la conexión o servidor.');
        });
    };

    const cancelarEdicion = () => {
        setModoEdicion(false);
        setProductoEditar(null);
        setNombre('');
        setCategoria('');
        setDescripcion('');
        setStock('');
        setPrecio('');
    };

    return (
        <div>
        <h2>Formulario de Producto</h2>
        {modoEdicion ? (
            <form className="w3-container w3-card-4 w3-yellow w3-text-red w3-margin" onSubmit={handleSubmit}>
                <label>Nombre:</label>
                <input
                    type="text"
                    value={nombre}
                    onChange={(e) => setNombre(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Categoría:</label>
                <input
                    type="text"
                    value={categoria}
                    onChange={(e) => setCategoria(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Descripción:</label>
                <textarea
                    value={descripcion}
                    onChange={(e) => setDescripcion(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Stock:</label>
                <input
                    type="number"
                    value={stock}
                    onChange={(e) => setStock(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Precio:</label>
                <input
                    type="number"
                    step="0.01"
                    value={precio}
                    onChange={(e) => setPrecio(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <button type="submit" className="w3-button w3-block w3-section w3-red w3-ripple">Guardar Cambios</button>
                <button type="button" className="w3-button w3-block w3-section w3-red w3-ripple" onClick={cancelarEdicion}>Cancelar</button>
            </form>
        ) : (
            <form className="w3-container w3-card-4 w3-yellow w3-text-red w3-margin" onSubmit={handleSubmit}>
                <label>Nombre:</label>
                <input
                    type="text"
                    value={nombre}
                    onChange={(e) => setNombre(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Categoría:</label>
                <input
                    type="text"
                    value={categoria}
                    onChange={(e) => setCategoria(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Descripción:</label>
                <textarea
                    value={descripcion}
                    onChange={(e) => setDescripcion(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Stock:</label>
                <input
                    type="number"
                    value={stock}
                    onChange={(e) => setStock(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label>Precio:</label>
                <input
                    type="number"
                    step="0.01"
                    value={precio}
                    onChange={(e) => setPrecio(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <button type="submit" className="w3-button w3-block w3-section w3-red w3-ripple">Guardar Producto</button>
            </form>
        )}

        {mensaje && <p>{mensaje}</p>}

        <h2>Lista de Productos</h2>
        <table className="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr className="w3-red">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {productos.map(producto => (
                    <tr key={producto.id}>
                        <td>{producto.id}</td>
                        <td>{producto.nombre}</td>
                        <td>{producto.categoria}</td>
                        <td>{producto.descripcion}</td>
                        <td>{producto.stock}</td>
                        <td>{producto.precio}</td>
                        <td>
                            <button className="w3-button w3-red w3-hover-pink" onClick={() => handleEliminarProducto(producto.id)}>Eliminar</button>
                        </td>
                    </tr>
                ))}
            </tbody>
        </table>
    </div>
    );
};

export default FormularioProducto;