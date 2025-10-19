<?php 
    namespace App\Filters;

    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\Filters\FilterInterface;

    class AuthCheck implements FilterInterface
    {
        public function before(RequestInterface $request, $arguments = null)
        {
            if (!session()->get('userdata')) {
                return redirect()->to('/admin-panel')->with('error', 'Please login first.');
            }
        }

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
        {
            // Nothing to do after response
        }
    }
