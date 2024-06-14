import React, { useState, useEffect } from 'react';

const FormularioVenta = () => {
    const [nombre, setNombre] = useState('');
    const [categoria, setCategoria] = useState('');
    const [precio, setPrecio] = useState('');
    const [cantidad, setCantidad] = useState('');
    const [total, setTotal] = useState('');
    const [ventas, setVentas] = useState([]);
    const [mensaje, setMensaje] = useState('');
    const [modoEdicion, setModoEdicion] = useState(false);
    const [ventaEditar, setVentaEditar] = useState(null);

    useEffect(() => {
        cargarVentas();
    }, []);

    const cargarVentas = () => {
        fetch('http://localhost/backend/listarventa.php')
            .then(response => response.json())
            .then(data => {
                setVentas(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        const venta = {
            nombre,
            categoria,
            precio: parseFloat(precio),
            cantidad: parseInt(cantidad),
            total: parseFloat(total)
        };

        const url = modoEdicion ? 'http://localhost/backend/modificarventa.php' : 'http://localhost/backend/insertarventa.php';

        fetch(url, {
            method: modoEdicion ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(venta),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.message === (modoEdicion ? 'Venta actualizada correctamente' : 'Venta insertada correctamente')) {
                setMensaje(`Venta ${data.id} ${modoEdicion ? 'actualizada' : 'insertada'} correctamente.`);
                cargarVentas();
                cancelarEdicion();
            } else {
                setMensaje(`Error al intentar ${modoEdicion ? 'actualizar' : 'guardar'} la venta.`);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            setMensaje('Error en la conexión o servidor.');
        });
    };

    const handleEliminarVenta = (id) => {
        fetch(`http://localhost/backend/eliminarventa.php?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Venta eliminada correctamente') {
                setMensaje(`Venta con ID ${id} eliminada correctamente.`);
                cargarVentas();
            } else {
                setMensaje('Error al intentar eliminar la venta.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            setMensaje('Error en la conexión o servidor.');
        });
    };

    const iniciarEdicion = (venta) => {
        setModoEdicion(true);
        setVentaEditar(venta);
        setNombre(venta.nombre);
        setCategoria(venta.categoria);
        setPrecio(venta.precio);
        setCantidad(venta.cantidad);
        setTotal(venta.total);
    };

    const cancelarEdicion = () => {
        setModoEdicion(false);
        setVentaEditar(null);
        setNombre('');
        setCategoria('');
        setPrecio('');
        setCantidad('');
        setTotal('');
    };

    return (
        <div>
        <h2>Formulario de Venta</h2>
        {modoEdicion ? (
            <form className="w3-container w3-card-4 w3-yellow w3-text-red w3-margin" onSubmit={handleSubmit}>
                <label htmlFor="nombre">Nombre:</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value={nombre}
                    onChange={(e) => setNombre(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="categoria">Categoría:</label>
                <input
                    type="text"
                    id="categoria"
                    name="categoria"
                    value={categoria}
                    onChange={(e) => setCategoria(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="precio">Precio:</label>
                <input
                    type="number"
                    step="0.01"
                    id="precio"
                    name="precio"
                    value={precio}
                    onChange={(e) => setPrecio(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="cantidad">Cantidad:</label>
                <input
                    type="number"
                    id="cantidad"
                    name="cantidad"
                    value={cantidad}
                    onChange={(e) => setCantidad(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="total">Total:</label>
                <input
                    type="number"
                    step="0.01"
                    id="total"
                    name="total"
                    value={total}
                    onChange={(e) => setTotal(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <button type="submit" className="w3-button w3-block w3-section w3-red w3-ripple">Guardar Cambios</button>
                <button type="button" className="w3-button w3-block w3-section w3-red w3-ripple" onClick={cancelarEdicion}>Cancelar</button>
            </form>
        ) : (
            <form className="w3-container w3-card-4 w3-yellow w3-text-red w3-margin" onSubmit={handleSubmit}>
                <label htmlFor="nombre">Nombre:</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value={nombre}
                    onChange={(e) => setNombre(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="categoria">Categoría:</label>
                <input
                    type="text"
                    id="categoria"
                    name="categoria"
                    value={categoria}
                    onChange={(e) => setCategoria(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="precio">Precio:</label>
                <input
                    type="number"
                    step="0.01"
                    id="precio"
                    name="precio"
                    value={precio}
                    onChange={(e) => setPrecio(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="cantidad">Cantidad:</label>
                <input
                    type="number"
                    id="cantidad"
                    name="cantidad"
                    value={cantidad}
                    onChange={(e) => setCantidad(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="total">Total:</label>
                <input
                    type="number"
                    step="0.01"
                    id="total"
                    name="total"
                    value={total}
                    onChange={(e) => setTotal(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <button type="submit" className="w3-button w3-block w3-section w3-red w3-ripple">Guardar Venta</button>
            </form>
        )}

        {mensaje && <p>{mensaje}</p>}

        <h2>Lista de Ventas</h2>
        <table className="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr className="w3-red">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {ventas.map(venta => (
                    <tr key={venta.id}>
                        <td>{venta.id}</td>
                        <td>{venta.nombre}</td>
                        <td>{venta.categoria}</td>
                        <td>{venta.precio}</td>
                        <td>{venta.cantidad}</td>
                        <td>{venta.total}</td>
                        <td>
                            <button className="w3-button w3-red w3-hover-pink" onClick={() => handleEliminarVenta(venta.id)}>Eliminar</button>
                        </td>
                    </tr>
                ))}
            </tbody>
        </table>
    </div>
    );
};

export default FormularioVenta;