import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import Nav from "./Nav";
import BtnLoader from "../Component/BtnLoader";
import axios from "axios";

const Cart = () => {
    const [cart, setCart] = useState([]);
    const [loader, setLoader] = useState(true);

    // payment info
    const [bank, setBank] = useState("");
    const [payment, setPayment] = useState({});
    useEffect(() => {
        axios.get("/api/cart").then(({ data }) => {
            setCart(data);
            setLoader(false);
        });
    }, []);

    const removeCart = (id) => {
        axios.post("/api/cart/" + id).then((d) => {
            if (d.data == "success") {
                showSuccess("Removed from cart.");
                const newCart = cart.filter((c) => c.id != id);
                setCart(newCart);
                return;
            }
        });
    };

    const addQty = (id) => {
        axios.post("/api/cart/add-qty/" + id).then((d) => {
            if (d.data == "success") {
                const newCart = cart.map((c) => {
                    if (c.id == id) {
                        c.qty += 1;
                    }
                    return c;
                });
                setCart(newCart);
                showSuccess("Qty updated.");
                return;
            }
        });
    };

    const TotalPrice = () => {
        var total = 0;
        cart.map((c) => {
            total += c.qty * c.product.sale_price;
        });
        return <span>{total}mmk</span>;
    };

    const checkout = () => {
        const data = new FormData();
        data.append("image", payment);
        data.append("bank", bank);
        axios.post("/api/checkout", data).then((d) => {
            if (d.data == "success") {
                setCart([]);
                showSuccess("Checkout Complete , wait for delivery .");
            }
        });
    };
    return (
        <div>
            <div className="card card-body">
                <Nav />
                <div>
                    {loader && (
                        <div className="p-5 d-flex justify-content-center align-items-center">
                            <BtnLoader />
                        </div>
                    )}
                    {!loader && (
                        <>
                            <table className="table table-striped">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>

                                    <th>Option</th>
                                    <th>Total</th>
                                </tr>
                                {cart.map((d) => (
                                    <tr>
                                        <td>
                                            <img
                                                src={d.product.image_url}
                                                style={{ width: 60 }}
                                                className="img-thumbnail"
                                            />
                                        </td>
                                        <td>{d.product.name}</td>
                                        <td>{d.product.sale_price}mmk</td>
                                        <td>
                                            <button className="btn btn-dark btn-sm">
                                                -
                                            </button>
                                            <span>{d.qty}</span>
                                            <button
                                                className="btn btn-dark btn-sm ml-2"
                                                onClick={() => addQty(d.id)}
                                            >
                                                +
                                            </button>
                                        </td>

                                        <td>
                                            <button
                                                className="btn btn-danger btn-sm"
                                                onClick={() => removeCart(d.id)}
                                            >
                                                <i className="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>
                                            {d.qty * d.product.sale_price}mmk
                                        </td>
                                    </tr>
                                ))}

                                <tr>
                                    <td colSpan={5}>
                                        <div className="text-right p-0 m-0">
                                            <b className="">Total Price</b>
                                        </div>
                                    </td>
                                    <td>
                                        <TotalPrice />
                                    </td>
                                </tr>
                            </table>
                            <div className="card card-body">
                                <div className="row">
                                    <div className="col-4">
                                        <span className="d-block">
                                            Your Phone
                                        </span>
                                        <input
                                            className="form-control"
                                            type="text"
                                            disabled
                                            value={blade_auth_user.phone}
                                        />
                                    </div>
                                    <div className="col-4">
                                        <span className="d-block">
                                            Payment Screenshot
                                        </span>
                                        <input
                                            onChange={(e) =>
                                                setPayment(e.target.files[0])
                                            }
                                            className="form-control"
                                            type="file"
                                        />
                                    </div>
                                    <div className="col-4">
                                        <span className="d-block">
                                            Bank Name
                                            <small className="text-warning">
                                                (wave,kpay,aya)
                                            </small>
                                        </span>
                                        <input
                                            onChange={(e) =>
                                                setBank(e.target.value)
                                            }
                                            className="form-control"
                                            type="text"
                                        />
                                    </div>
                                    <div className="col-12 mt-3">
                                        <span className="d-block">
                                            Delivery Address
                                        </span>
                                        <textarea
                                            disabled
                                            className="form-control"
                                        >
                                            {blade_auth_user.delivery_address}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <button
                                onClick={checkout}
                                className="btn btn-primary"
                            >
                                Check Out
                            </button>
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};

export default Cart;
