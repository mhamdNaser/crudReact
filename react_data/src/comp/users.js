import React, { useState, useEffect } from 'react';
import axios from 'axios';

function Data() {
    const [data, setData] = useState([]);
    const [editingItem, setEditingItem] = useState(null);

    useEffect(() => {
        axios.get('http://localhost/CRUD_react/backend/read.php').then(response => {
            setData(response.data);
        });
    }, []);

    const handleEdit = (id) => {
        const itemToEdit = data.find(item => item.id === id);
        setEditingItem(itemToEdit);
    }

    const handleUpdate = (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const updatedItem = {
            id: editingItem.id,
            username: formData.get('username'),
            email: formData.get('email'),
            password: formData.get('password')
        };
        axios.put(`http://localhost/CRUD_react/backend/update.php?id=${editingItem.id}`, updatedItem)
            .then(response => {
                setData(data.map(item => item.id === editingItem.id ? updatedItem : item));
                setEditingItem(null);
            })
            .catch(error => {
                console.log(error);
            });
    }

    const handleDelete = (id) => {
        axios.delete(`http://localhost/CRUD_react/backend/delete.php?id=${id}`)
            .then(response => {
                setData(data.filter(item => item.id !== id));
            })
            .catch(error => {
                console.log(error);
            });
    }

    return (
        <div className='row p-5 mt-5 justify-content-center'>
            <div className='col-lg-6'>
                <table className="table">
                    <thead className="table-dark">
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>password</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        {data.map(item =>
                            <tr key={item.id}>
                                <td>{item.id}</td>
                                <td>{item.username}</td>
                                <td>{item.email}</td>
                                <td>{item.password}</td>
                                <td>
                                    <button className="btn btn-primary" onClick={() => handleEdit(item.id)}>Edit</button>
                                </td>
                                <td>
                                    <button className="btn btn-danger" onClick={() => handleDelete(item.id)}>Delete</button>
                                </td>
                            </tr>
                        )}
                    </tbody>
                </table>
                {editingItem &&
                    <form onSubmit={handleUpdate}>
                        <div className="form-group">
                            <label htmlFor="username">Name:</label>
                            <input type="text" className="form-control" id="username" name="username" defaultValue={editingItem.username} required />
                        </div>
                        <div className="form-group">
                            <label htmlFor="email">Email:</label>
                            <input type="email" className="form-control" id="email" name="email" defaultValue={editingItem.email} required />
                        </div>
                        <div className="form-group">
                            <label htmlFor="password">Password:</label>
                            <input type="password" className="form-control" id="password" name="password" defaultValue={editingItem.password} required />
                        </div>
                        <button type="submit" className="btn btn-primary">Update</button>
                    </form>
                }
            </div>
        </div>
    );
}

export default Data
