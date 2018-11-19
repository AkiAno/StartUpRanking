import React, { Component } from "react";
import ReactDOM from "react-dom";
import "./footer.css";

class Footer extends Component {
    render() {
        return (
            <div>
                <div className="footer fixed-bottom d-flex align-items-lg-center justify-content-lg-center">
                    copyright @Startups Today
                </div>
            </div>
        );
    }
}

export default Footer;
