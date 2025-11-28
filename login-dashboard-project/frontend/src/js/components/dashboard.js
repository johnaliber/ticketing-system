import React, { useEffect, useState } from 'react';
import { fetchUserData } from '../api/client';

const Dashboard = () => {
    const [userData, setUserData] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const getUserData = async () => {
            try {
                const data = await fetchUserData();
                setUserData(data);
            } catch (err) {
                setError('Failed to fetch user data');
            } finally {
                setLoading(false);
            }
        };

        getUserData();
    }, []);

    if (loading) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>{error}</div>;
    }

    return (
        <div>
            <h1>Dashboard</h1>
            {userData ? (
                <div>
                    <h2>Welcome, {userData.username}</h2>
                    <p>Your email: {userData.email}</p>
                    {/* Add more user-specific data here */}
                </div>
            ) : (
                <p>No user data available.</p>
            )}
        </div>
    );
};

export default Dashboard;