import './styles/app.css';
import './bootstrap';

import React from 'react';
import ReactDOM from 'react-dom';
import HomePage from './react/page/home';
import ArticlePage from './react/page/article';
import LoginPage from './react/page/login';

import { BrowserRouter, Routes, Route } from "react-router-dom";
import Navigation from './react/page/nav';
class App extends React.Component {
    render() {


        return (

            <
            BrowserRouter >

            <
            Routes >

            <
            Route path = "/"
            element = { < HomePage / > }
            />  <
            Route path = "/article"
            element = { < ArticlePage / > }
            />  <
            Route path = "/login"
            element = { < LoginPage / > }
            />  <
            /Routes>

            <
            /BrowserRouter>
        );
    }
}

ReactDOM.render( < App / > , document.getElementById('root'));