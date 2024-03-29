import React, { useState } from "react";
import { createRoot } from "react-dom/client";
import StarRatings from "react-star-ratings";
const Test = () => {
    const [ra, setRa] = useState(2);
    return (
        <div>
            <StarRatings
                rating={ra}
                starRatedColor="blue"
                changeRating={(no) => {
                    setRa(no);
                }}
                numberOfStars={5}
                name="rating"
            />
        </div>
    );
};

createRoot(document.getElementById("root")).render(<Test />);
