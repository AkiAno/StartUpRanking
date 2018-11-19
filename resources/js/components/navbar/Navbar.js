import React, { Component } from "react";
import { Router, Route, Link } from "react-router";
import Header from "./Header";
import "./style.css";

class Navbar extends Component {
    render() {
        return (
            <div>
                <nav
                    id="nav-menu"
                    className="navbar navbar-expand-md navbar-laravel"
                >
                    <div className="container-fluid">
                        <div className="navbar-header">
                            <Header />
                        </div>
                        <ul className="nav navbar-nav">
                            <li className="active">
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="/news">News</a>
                            </li>
                            <li>
                                <a href="#">Login</a>
                            </li>
                            <li>
                                <a href="#">Register</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div>{this.props.children}</div>
            </div>
        );
    }
}
export default Navbar;
