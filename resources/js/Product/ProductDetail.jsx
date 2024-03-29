import axios from "axios";
import React, { useEffect, useState } from "react";
import { createRoot } from "react-dom/client";
import BtnLoader from "../Component/BtnLoader";
import StarRatings from "react-star-ratings";
//@params from blade blade_product
//from product/detail.blade.php

const ProductDetail = () => {
    const [cartLoader, setCartLoader] = useState(false);
    const [saveLoader, setSaveLoader] = useState(false);

    const [rateNo, setRateNo] = useState(0);
    const [review, setReview] = useState("");
    const [reviews, setReviews] = useState([]);
    const [loader, setLoader] = useState(true);
    useEffect(() => {
        axios
            .get("/api/product-review/" + blade_product.id)
            .then(({ data }) => {
                setReviews(data);
                setLoader(false);
            });
    }, []);

    const addToCart = () => {
        setCartLoader(true);
        axios
            .post("/api/add-to-cart", { slug: blade_product.slug })
            .then((d) => {
                if (d.data == "product_not_found") {
                    showError("Product Not Found.");
                    return;
                }
                if (d.data == "not_enough_qty") {
                    showError("Not enough quantity.");
                    return;
                }
                if (d.data.message == "success") {
                    changeCartQty(d.data.cart_qty);
                    showSuccess("Added to cart.");
                }
                setCartLoader(false);
            });
    };

    const saveProduct = () => {
        setSaveLoader(true);
        const data = { slug: blade_product.slug };
        axios.post("/api/save-product", data).then(({ data }) => {
            setSaveLoader(false);
            if (data == "product_not_found") {
                showError("Product Not Found");
                return;
            }
            if (data == "already_save") {
                showError("Product already in fav.");
                return;
            }

            if (data == "success") {
                showSuccess("Added To Fav");
            }
        });
    };

    const makeReview = () => {
        const data = {
            rating: rateNo,
            review,
            product_id: blade_product.id,
        };
        axios.post("/api/make-review", data).then(({ data }) => {
            if (data == "not_found") {
                showError("Product Not Found");
                return;
            }
            setRateNo(0);
            setReview("");
            showSuccess("Thanks you.");
            setReviews([...reviews, data]);
        });
    };
    return (
        <>
            <div className="card p-4">
                <div className="row">
                    <div className="col-12 mb-3">
                        <h3>{blade_product.name}</h3>
                        <div>
                            <small className="text-muted">Brand:</small>
                            <small className="badge badge-dark">
                                {blade_product.brand.name}
                            </small>
                            |<small className="text-muted">Category:</small>
                            {blade_product.category.map((c) => (
                                <small className="badge badge-dark">
                                    {c.name}
                                </small>
                            ))}
                        </div>
                    </div>
                    <div className="col-12 col-sm-12 col-md-4 col-lg-4">
                        <img
                            className="w-100"
                            src={blade_product.image_url}
                            alt=""
                        />
                    </div>
                    <div className="col-12 col-sm-12 col-md-8 col-lg-8">
                        <div className="mt-5">
                            <p>
                                <small className="text-muted">
                                    <strike>
                                        {blade_product.discounted_price}ks
                                    </strike>
                                </small>
                                <span className="text-danger fs-1 d-inline">
                                    {blade_product.sale_price}ks
                                </span>
                                <br />
                                <span className="btn btn-sm btn-outline-success text-success mt-3">
                                    InStock :{blade_product.qty}
                                </span>
                                <button
                                    disabled={cartLoader}
                                    className="btn btn-sm btn-danger mt-3"
                                    onClick={addToCart}
                                >
                                    <i className="fas fa-shopping-cart" />
                                    Add To Cart
                                    {cartLoader && <BtnLoader />}
                                </button>
                                <button
                                    disabled={saveLoader}
                                    className="btn btn-warning btn-sm mt-3"
                                    onClick={saveProduct}
                                >
                                    <i className="far fa-save"></i>
                                    Add to favoriate
                                    {saveLoader && <BtnLoader />}
                                </button>
                            </p>
                            <p className="mt-5">{blade_product.description}</p>
                            <small className="text-muted">
                                Available Color:
                            </small>
                            {blade_product.color.map((c) => (
                                <span className="badge badge-danger">
                                    {c.name}
                                </span>
                            ))}
                            <div className="mt-2"></div>
                            <small className="text-muted">
                                Available Size:
                            </small>
                            {blade_product.size.map((c) => (
                                <span className="badge badge-dark">
                                    {c.name}
                                </span>
                            ))}
                        </div>
                    </div>
                    <hr />
                    <div className="col-12" style={{ marginTop: 100 }}>
                        {loader && (
                            <div className="d-flex justify-content-center align-items-center p-5">
                                {<BtnLoader />}
                            </div>
                        )}
                        {!loader && (
                            <>
                                {reviews.map((r) => (
                                    <div className="review">
                                        <div className="card p-3">
                                            <div className="row">
                                                <div className="col-md-2">
                                                    <div className="d-flex justify-content-between">
                                                        <img
                                                            className="w-100 rounded-circle"
                                                            src="assets/images/user.jpeg"
                                                            alt=""
                                                        />
                                                    </div>
                                                </div>
                                                <div className="col-md-10">
                                                    <div className="rating">
                                                        <StarRatings
                                                            rating={r.rating}
                                                            starRatedColor="#fb6340"
                                                            numberOfStars={5}
                                                            name="rating"
                                                            starDimension="15px"
                                                        />
                                                    </div>
                                                    <div className="name">
                                                        <b>{r.user.name}</b>
                                                    </div>
                                                    <div className="mt-3">
                                                        <small>
                                                            {r.review}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </>
                        )}
                        {/* loop review */}

                        <div className="add-review mt-5">
                            <h4>Make Review</h4>
                            <div className="">
                                <StarRatings
                                    rating={rateNo}
                                    starRatedColor="#fb6340"
                                    starHoverColor="#fb6340"
                                    changeRating={(e) => {
                                        setRateNo(e);
                                    }}
                                    numberOfStars={5}
                                    name="rating"
                                />
                            </div>
                            <div>
                                <textarea
                                    onChange={(e) => setReview(e.target.value)}
                                    className="form-control"
                                    rows={5}
                                    placeholder="enter review"
                                    value={review}
                                />
                                <button
                                    onClick={makeReview}
                                    className="btn btn-dark float-right mt-3"
                                >
                                    Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

createRoot(document.getElementById("root")).render(<ProductDetail />);
