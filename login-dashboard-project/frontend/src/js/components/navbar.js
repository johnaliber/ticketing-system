import React from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
    return (
        <nav className="navbar">
            <div className="navbar-brand">
                <Link to="/">Home</Link>
            </div>
            <div className="navbar-links">
                <Link to="/dashboard">Dashboard</Link>
                <Link to="/login">Login</Link>
                <Link to="/logout">Logout</Link>
            </div>
        </nav>
    );
};

export default Navbar;