import React from 'react';
import { Link } from 'react-router-dom';

const NavBar = () => {
  return (
    <nav className='w3-bar w3-yellow'>
      <ul>
        <li className='w3-bar-item w3-button w3-right w3-hover-light-blue'><Link to="/">Inicio</Link></li>
        <li className='w3-bar-item w3-button w3-right w3-hover-light-blue'><Link to="/productos">Productos</Link></li>
        <li className='w3-bar-item w3-button w3-right w3-hover-light-blue'><Link to="/distribuidores">Distribuidores</Link></li>
        <li className='w3-bar-item w3-button w3-right w3-hover-light-blue'><Link to="/ventas">Ventas</Link></li>
      </ul>
    </nav>
  );
};

export default NavBar;