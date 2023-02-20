import React, { useState } from 'react'
import axios from 'axios'
import { useNavigate } from 'react-router-dom'

const CreateUser = () => {
    const navigate = useNavigate();
    const [inputs, setInputs] = useState({})

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setInputs(values => ({ ...values, [name]: value }));
    }

    const handleSubmit = (event) => {
        event.preventDefault();
        axios.post('http://localhost/CRUD_react/backend/create.php', inputs).then(function (response) {
            console.log(response.data);
            navigate('/');
        })
    }

    return (
        <div>
            <h1>Create a new user</h1>
            <form onSubmit={(e) => handleSubmit(e)}>
                <label>Name:</label>
                <input type="text" name="username" onChange={handleChange} />
                <br />
                <label>Email:</label>
                <input type="text" name="email" onChange={handleChange} />
                <br />
                <label>Password:</label>
                <input type="text" name="password" onChange={handleChange} />
                <br />
                <button type='submit'>Save</button>
            </form>
        </div>
    )
}

export default CreateUser