import React from "react";
import { Link } from "react-router-dom";
const Nav = () => {
    return (
        <div>
            <Link to={"/"} className="btn btn-warning">
                Cart
            </Link>
            <Link to={"/order"} className="btn btn-warning">
                Order
            </Link>
            <Link to={"/fav"} className="btn btn-warning">
                Fav Product
            </Link>
            <Link to={"/change-password"} className="btn btn-warning">
                Change Password
            </Link>
            <Link to={"/delivery"} className="btn btn-warning">
                Change Delivery Info
            </Link>
        </div>
    );
};

export default Nav;
