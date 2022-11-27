import React from 'react';
import { NavLink } from 'react-router-dom';

export default function Navigation(){
    return (
        <div className="navbar">
            <ul>
            <NavLink to="/">
                    <li>Home</li>
                </NavLink>
                <NavLink to="/article">
                    <li>Article</li>
                </NavLink>
                <NavLink to="/login">
                    <li>Login</li>
                </NavLink>
            </ul>

        </div>
    );
};
