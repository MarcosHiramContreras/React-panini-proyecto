import React from 'react';
import { Route, Routes } from 'react-router-dom';
import NavBar from './components/NavBar';
import Home from './components/Home';
import FormularioProducto from './components/FormularioProducto';
import FormularioDistribuidor from './components/FormularioDistribuidor';
import FormularioVenta from './components/FormularioVenta';

const App = () => {
  return (
    <div>
      <NavBar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/productos" element={<FormularioProducto />} />
        <Route path="/distribuidores" element={<FormularioDistribuidor/>} />
        <Route path="/ventas" element={<FormularioVenta/>} />
      </Routes>
    </div>
  );
};

export default App;
