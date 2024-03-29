import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Route, Routes } from "react-router-dom";
import Cart from "./profile/Cart";
import Order from "./profile/Order";
import ChangePassword from "./profile/ChangePassword";

const Profile = () => {
    return (
        <HashRouter>
            <Routes>
                <Route path="/" element={<Cart />} />
                <Route path="/order" element={<Order />} />
                <Route path="/change-password" element={<ChangePassword />} />
            </Routes>
        </HashRouter>
    );
};
createRoot(document.querySelector("#root")).render(<Profile />);
