import React, { useState } from "react";
import Nav from "./Nav";
import axios from "axios";

const ChangePassword = () => {
    const [oldPassword, setOldPassword] = useState("");
    const [newPassword, setNewPassword] = useState("");

    const change = () => {
        const data = {
            new_password: newPassword,
            old_password: oldPassword,
        };
        axios.post("/api/change-password", data).then((d) => {
            if (d.data == "wrong_password") {
                showError("Wrong Current Password");
                return;
            }
            if (d.data == "success") {
                showSuccess("Password Changed Successfully.");
            }
        });
    };
    return (
        <div className="card card-body">
            <Nav />
            <div className="row">
                <div className="col-6">
                    <div className="form-group">
                        <label htmlFor="">Enter Current Password</label>
                        <input
                            type="text"
                            onChange={(e) => setOldPassword(e.target.value)}
                            className="form-control"
                            id=""
                        />
                    </div>
                </div>
                <div className="col-6">
                    <div className="form-group">
                        <label htmlFor="">Enter New Password</label>
                        <input
                            type="text"
                            onChange={(e) => setNewPassword(e.target.value)}
                            className="form-control"
                            id=""
                        />
                    </div>
                </div>
                <div className="col-12">
                    <div>
                        <button onClick={change} className="btn btn-dark">
                            Change
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ChangePassword;
