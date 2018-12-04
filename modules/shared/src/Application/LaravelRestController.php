<?php

namespace Chaos\Common\Application;

use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Chaos\Common\Support\Contracts\ConfigAware;
use Chaos\Common\Support\Contracts\ContainerAware;
use Chaos\Common\Extension\Doctrine\EntityManagerFactory;

/**
 * Class LaravelRestController
 * @author ntd1712
 */
abstract class LaravelRestController extends Controller
{
    use ConfigAware, ContainerAware,
        Contracts\ControllerAware, Contracts\ServiceAware;

    /**
     * Constructor.
     *
     * @param   \ArrayAccess|array $container An array holding the paths to the service files.
     * @param   \ArrayAccess|array $config An array holding the paths to the config files.
     * @throws  \Exception
     */
    public function __construct($container = [], $config = [])
    {
        $this->setContainer($container)->setVars($config);
        $this->getContainer()->set(VARS, $this->getVars());
        $this->getContainer()->set(
            ENTITY_MANAGER,
            (new EntityManagerFactory)->__invoke(null, null, $this->getVars()->getContent())
        );

        var_dump(
            $this->getContainer()->get(VARS)->getContent(),
            $this->getContainer()->get(ENTITY_MANAGER)
        );
    }

    /**
     * Display a listing of the resource.
     *
     * This is the default `index` action, you can override this in the derived class.
     * GET /lookup?filter=&sort=&start=&length=
     *
     * @return  array|\Illuminate\Http\Response
     */
    public function index()
    {
//        return $this->getService()->readAll($this->getFilterParams(), $this->getPagerParams());
    }

    /**
     * Store a newly created resource in storage.
     *
     * This is the default `store` action, you can override this in the derived class.
     * POST /lookup
     *
     * @param   \Illuminate\Http\Request $request
     * @return  array|\Illuminate\Http\Response
     */
    public function store($request)
    {
//        return $this->getService()->create($this->getRequest());
    }

    /**
     * Display the specified resource.
     *
     * This is the default `show` action, you can override this in the derived class.
     * GET /lookup/{lookup}
     *
     * @param   mixed $id The route parameter ID.
     * @return  array|\Illuminate\Http\Response
     */
    public function show($id)
    {
//        return $this->getService()->read($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * This is the default `update` action, you can override this in the derived class.
     * PUT /lookup/{lookup}
     *
     * @param  \Illuminate\Http\Request $request
     * @param   mixed $id The route parameter ID.
     * @return  array|\Illuminate\Http\Response
     */
    public function update($request, $id)
    {
//        return $this->getService()->update($this->getRequest(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * This is the default `destroy` action, you can override this in the derived class.
     * DELETE /lookup/{lookup}
     *
     * @param   mixed $id The route parameter ID.
     * @return  array|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        return $this->getService()->delete($id);
    }

    // <editor-fold desc="Private methods">

    /**
     * Either get a query value or all of the input and files.
     *
     * @param   null|string $key The request parameter key.
     * @param   mixed $default [optional] The default value.
     * @return  array|mixed
     * @throws  \Exception
     */
    protected function getRequest($key = null, $default = null)
    {
        if (isset($key)) {
            return request($key, $default);
        }

        $params = request()->all();

        if (null === $default) {
            $params['EditedAt'] = 'now';
            $params['EditedBy'] = session('loggedName');
            $params['NotUse'] = 'false';
            $params['Uuid'] = Uuid::uuid4()->toString();
            $params['ApplicationKey'] = $this->getVars()->get('app.key');

            return $params;
        }

        return $params;
    }

    // </editor-fold>
}