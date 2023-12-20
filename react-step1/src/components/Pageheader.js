import React from 'react';
import { Link } from 'react-router-dom';

export default function Pheader(){

    const showAlert = (value) => {
        alert("Alert noe woron ");
        alert(value);
    }

  return ( 
    <nav className="navbar navbar-expand-lg bg-white shadow-lg">
    <div className="container">
        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
        </button>
        
        <a className="navbar-brand" href="index.html">
            Crispy Kitchen
        </a>

        <div className="d-lg-none">
            <button type="button" className="custom-btn btn btn-danger" data-bs-toggle="modal" data-bs-target="#BookingModal">Reservation</button>
        </div>

        <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav mx-auto">
                <li className="nav-item">
                    <Link className="nav-link active" to="/">Home</Link>
                </li>

                <li className="nav-item">
                    <Link className="nav-link" to="/about">About</Link>
                </li>

                <li className="nav-item">
                    <Link className="nav-link" to="/menu" onClick ={()=>{showAlert('this is new eveent')}}>Menu</Link>
                </li>

                <li className="nav-item">
                   <Link className="nav-link" to="/news">Our Updates</Link>
                </li>

                <li className="nav-item">
                    <Link className="nav-link" to="/contact">Contact</Link>
                </li>
            </ul>
        </div>

        <div className="d-none d-lg-block">
            <button type="button" className="custom-btn btn btn-danger" data-bs-toggle="modal" data-bs-target="#BookingModal">Reservation</button>
        </div>

    </div>
</nav>
  )
}
