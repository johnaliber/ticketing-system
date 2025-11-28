import { login } from '../src/js/api/auth';

describe('Authentication', () => {
    beforeEach(() => {
        document.body.innerHTML = `
            <form id="login-form">
                <input type="text" id="username" name="username" required />
                <input type="password" id="password" name="password" required />
                <button type="submit">Login</button>
            </form>
        `;
    });

    it('should call login function with correct parameters', async () => {
        const username = 'testuser';
        const password = 'testpassword';
        document.getElementById('username').value = username;
        document.getElementById('password').value = password;

        const loginSpy = jest.spyOn(auth, 'login').mockImplementation(() => Promise.resolve({ success: true }));

        const form = document.getElementById('login-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            await login(username, password);
        });

        form.dispatchEvent(new Event('submit'));

        expect(loginSpy).toHaveBeenCalledWith(username, password);
        loginSpy.mockRestore();
    });

    it('should show error message on failed login', async () => {
        const username = 'wronguser';
        const password = 'wrongpassword';
        document.getElementById('username').value = username;
        document.getElementById('password').value = password;

        jest.spyOn(auth, 'login').mockImplementation(() => Promise.resolve({ success: false, message: 'Invalid credentials' }));

        const form = document.getElementById('login-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const response = await login(username, password);
            if (!response.success) {
                const errorMessage = document.createElement('div');
                errorMessage.textContent = response.message;
                document.body.appendChild(errorMessage);
            }
        });

        form.dispatchEvent(new Event('submit'));

        const errorMessage = await new Promise((resolve) => {
            setTimeout(() => {
                resolve(document.body.querySelector('div').textContent);
            }, 100);
        });

        expect(errorMessage).toBe('Invalid credentials');
    });
});