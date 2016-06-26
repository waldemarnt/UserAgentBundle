# User Agent Version Bundle

> Suppose that we have an API or a external connection that needs validation by user-agent, by version, this bundle will fall like a glove in your pretty hands.


## Usage

The list is separated by kind.


### Installation
Add it as dependency in your composer.json
```json
    "require": {
        "waldemarnt/user-agent-bundle": "2.*"
    }
```

Update your **AppKernel.php** and add this line

```php
    new Wneto\UserAgentBundle\WnetoUserAgentBundle(),
```

### Usage
First of all you need understand how this stuff works.
For example, a browser request send headers like this:
```json
Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.99 Safari/537.36
```
This example was did using POSTMAN, well, lets suppose that i need receive only requests from Mozilla that have version higher than 5.0. What i need to do that?
Kepp calm, lets do it!
First of all we need the configuration inside the **config.yml** file
```yml
# you can found a sample inside Wneto/UserAgentBundle/Resources/samples/config/user_agent.yml
wneto_user_agent:
    enabled: true
    type: whitelist # blacklist or whitelist. With whitelist all request will be blocked and accept requests only from the setted patterns
    use_event_listener: true # You can opt to use the event listener defined on the bundle or use the second option below
    patterns:
        - { pattern: "Mozilla", version: "5.0", operator: ">" }
```
Lets understand,
pattern is the name of the agent, the name is before the **/** bar in the agent, **allowed** is a boolean and the **version** will be the version that you need set the rule, the **operator** is used to applicate the rule for example higher than **>** higher of equals than **>=** the same in inverse **<** , **<=**

Ok now in our application we just need add a verification like this one:
First inject the service **@user_agent.validator.user_agent** in your class.

```php
    public function isDeviceAllowed($request){
        if($this->userAgentValidator->isEnabled()) {
            return $this->userAgentValidator->isAllowed($request->headers->get('user-agent'));
        }

        return true;
    }
```
Ok, the magic will happen and we will be happy forever.
