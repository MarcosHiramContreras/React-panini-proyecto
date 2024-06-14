import React, { useState, useEffect } from 'react';

const FormularioDistribuidor = () => {
    const [nombre, setNombre] = useState('');
    const [telefono, setTelefono] = useState('');
    const [direccion, setDireccion] = useState('');
    const [correo, setCorreo] = useState('');
    const [distribuidores, setDistribuidores] = useState([]);
    const [mensaje, setMensaje] = useState('');
    const [modoEdicion, setModoEdicion] = useState(false);
    const [distribuidorEditar, setDistribuidorEditar] = useState(null);

    useEffect(() => {
        cargarDistribuidores();
    }, []);

    const cargarDistribuidores = () => {
        fetch('http://localhost/backend/listardistribuidor.php')
            .then(response => response.json())
            .then(data => {
                setDistribuidores(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        const distribuidor = {
            nombre,
            telefono,
            direccion,
            correo,
        };

        const url = modoEdicion ? 'http://localhost/backend/modificardistribuidor.php' : 'http://localhost/backend/insertardistribuidor.php';

        fetch(url, {
            method: modoEdicion ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(distribuidor),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.message === (modoEdicion ? 'Distribuidor actualizado correctamente' : 'Distribuidor insertado correctamente')) {
                setMensaje(`Distribuidor ${data.id} ${modoEdicion ? 'actualizado' : 'insertado'} correctamente.`);
                cargarDistribuidores();
                cancelarEdicion();
            } else {
                setMensaje(`Error al intentar ${modoEdicion ? 'actualizar' : 'guardar'} el distribuidor.`);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            setMensaje('Error en la conexión o servidor.');
        });
    };

    const handleEliminarDistribuidor = (id) => {
        fetch(`http://localhost/backend/eliminardistribuidor.php?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Distribuidor eliminado correctamente') {
                setMensaje(`Distribuidor con ID ${id} eliminado correctamente.`);
                cargarDistribuidores();
            } else {
                setMensaje('Error al intentar eliminar el distribuidor.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            setMensaje('Error en la conexión o servidor.');
        });
    };

    const iniciarEdicion = (distribuidor) => {
        setModoEdicion(true);
        setDistribuidorEditar(distribuidor);
        setNombre(distribuidor.nombre);
        setTelefono(distribuidor.telefono);
        setDireccion(distribuidor.direccion);
        setCorreo(distribuidor.correo);
    };

    const cancelarEdicion = () => {
        setModoEdicion(false);
        setDistribuidorEditar(null);
        setNombre('');
        setTelefono('');
        setDireccion('');
        setCorreo('');
    };

    return (
        <div>
        <h2>Formulario de Distribuidor</h2>
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
                <label htmlFor="telefono">Teléfono:</label>
                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    value={telefono}
                    onChange={(e) => setTelefono(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="direccion">Dirección:</label>
                <textarea
                    id="direccion"
                    name="direccion"
                    value={direccion}
                    onChange={(e) => setDireccion(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="correo">Correo:</label>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value={correo}
                    onChange={(e) => setCorreo(e.target.value)}
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
                <label htmlFor="telefono">Teléfono:</label>
                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    value={telefono}
                    onChange={(e) => setTelefono(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="direccion">Dirección:</label>
                <textarea
                    id="direccion"
                    name="direccion"
                    value={direccion}
                    onChange={(e) => setDireccion(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <label htmlFor="correo">Correo:</label>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value={correo}
                    onChange={(e) => setCorreo(e.target.value)}
                    required
                    className="w3-input"
                /><br />
                <button type="submit" className="w3-button w3-block w3-section w3-red w3-ripple">Guardar Distribuidor</button>
            </form>
        )}

        {mensaje && <p>{mensaje}</p>}

        <h2>Lista de Distribuidores</h2>
        <table className="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr className="w3-red">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {distribuidores.map(distribuidor => (
                    <tr key={distribuidor.id}>
                        <td>{distribuidor.id}</td>
                        <td>{distribuidor.nombre}</td>
                        <td>{distribuidor.telefono}</td>
                        <td>{distribuidor.direccion}</td>
                        <td>{distribuidor.correo}</td>
                        <td>
                            <button className="w3-button w3-red w3-hover-pink" onClick={() => handleEliminarDistribuidor(distribuidor.id)}>Eliminar</button>
                        </td>
                    </tr>
                ))}
            </tbody>
        </table>
    </div>
);
};

export default FormularioDistribuidor;