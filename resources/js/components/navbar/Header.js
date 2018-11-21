import React from "react";
import { Link } from "react-router-dom";
import "./style.css";

const Header = () => (
    <div className="container">
        <Link id="link" className="navbar-brand" to="/">
            <span className="start">Start</span>
            <span className="ups">ups</span>{" "}
            <span className="today">Today</span>
        </Link>
    </div>
);

export default Header;
