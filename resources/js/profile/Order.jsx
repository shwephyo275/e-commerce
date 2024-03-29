import React, { useEffect, useState } from "react";
import Nav from "./Nav";
import BtnLoader from "../Component/BtnLoader";
import axios from "axios";

const Cart = () => {
    const [loader, setLoader] = useState(true);
    const [order, setOrder] = useState([]);
    const [orderPaginate, setOrderPaginate] = useState({});
    const [page, setPage] = useState(1);

    useEffect(() => {
        setLoader(true);
        axios.get("/api/order?page=" + page).then((d) => {
            setOrderPaginate(d.data);
            setOrder(d.data.data);
            setLoader(false);
        });
    }, [page]);

    const TotalPrice = ({ products }) => {
        var total = 0;
        products.map((c) => {
            total += c.qty * c.product.sale_price;
        });
        return <span>{total}mmk</span>;
    };

    return (
        <div className="card card-body">
            <Nav />
            {loader && (
                <div className="d-flex p-5 align-items-center justify-content-center">
                    <BtnLoader />
                </div>
            )}
            {!loader && (
                <>
                    <table className="table table-striped">
                        <tr>
                            <th>Payment Image</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                        {order.map((d) => (
                            <tr key={d.id}>
                                <td>
                                    <img
                                        src={d.image_url}
                                        className="img-thumbnail"
                                        style={{ width: 50 }}
                                    />
                                </td>
                                <td>
                                    <TotalPrice products={d.products} />
                                </td>
                                <td>
                                    {d.status == "pending" && (
                                        <span className="badge badge-warning">
                                            Pending
                                        </span>
                                    )}
                                    {d.status == "deliver" && (
                                        <span className="badge badge-success">
                                            on deliver
                                        </span>
                                    )}
                                    {d.status == "reject" && (
                                        <span className="badge badge-error">
                                            Rejected
                                        </span>
                                    )}
                                </td>
                                <td>
                                    <button
                                        className="btn btn-primary"
                                        data-toggle="modal"
                                        data-target={`#id${d.id}`}
                                    >
                                        <i className="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </table>
                    <div>
                        <button
                            onClick={() => setPage(page - 1)}
                            className="btn btn-dark"
                            disabled={
                                orderPaginate.prev_page_url == null
                                    ? true
                                    : false
                            }
                        >
                            Prev
                        </button>
                        <button
                            onClick={() => setPage(page + 1)}
                            className="btn btn-dark"
                            disabled={
                                orderPaginate.next_page_url == null
                                    ? true
                                    : false
                            }
                        >
                            Next
                        </button>
                    </div>
                </>
            )}

            {/* product detail modal */}
            {order.map((d) => (
                <div
                    className="modal fade"
                    id={`id${d.id}`}
                    tabIndex={-1}
                    role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div className="modal-dialog" role="document">
                        <div className="modal-content">
                            <div className="modal-body">
                                <table className="table table-striped">
                                    <tr>
                                        <th>Image</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                    {d.products.map((p) => (
                                        <tr key={p.id}>
                                            <td>
                                                <img
                                                    src={p.product.image_url}
                                                    style={{ width: 50 }}
                                                />
                                            </td>
                                            <td>{p.qty}</td>
                                            <td>{p.product.sale_price}</td>
                                        </tr>
                                    ))}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
};

export default Cart;
